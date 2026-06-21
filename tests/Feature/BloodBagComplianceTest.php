<?php

namespace Tests\Feature;

use App\Models\BloodBag;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloodBagComplianceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create(), ['*']);
    }

    public function test_available_stock_returns_only_safe_and_unexpired_bags_in_fifo_order(): void
    {
        // Bag 1: Safe and expires later
        BloodBag::factory()->create([
            'status' => 'In Storage',
            'screening_status' => 'Passed',
            'temperature_breached' => false,
            'expiry_date' => now()->addDays(10)->toDateString(),
        ]);

        // Bag 2: Safe but expires sooner (should be first in FIFO)
        BloodBag::factory()->create([
            'status' => 'In Storage',
            'screening_status' => 'Passed',
            'temperature_breached' => false,
            'expiry_date' => now()->addDays(2)->toDateString(),
        ]);

        // Bag 3: Unsafe (failed screening) - should not appear
        BloodBag::factory()->create([
            'status' => 'In Storage',
            'screening_status' => 'Failed',
            'temperature_breached' => false,
            'expiry_date' => now()->addDays(5)->toDateString(),
        ]);

        // Bag 4: Expired - should not appear
        BloodBag::factory()->create([
            'status' => 'In Storage',
            'screening_status' => 'Passed',
            'temperature_breached' => false,
            'expiry_date' => now()->subDays(1)->toDateString(),
        ]);

        $response = $this->getJson('/api/blood-bank/available');

        $response->assertStatus(200)
                 ->assertJsonCount(2);

        // Assert FIFO order (expires sooner comes first)
        $this->assertEquals(now()->addDays(2)->toDateString(), $response->json()[0]['expiry_date']);
        $this->assertEquals(now()->addDays(10)->toDateString(), $response->json()[1]['expiry_date']);
    }

    public function test_sensor_update_flags_temperature_breach_for_prbc(): void
    {
        $bag = BloodBag::factory()->create([
            'bag_rfid' => 'PRBC-123',
            'component_type' => 'Packed Red Blood Cells',
            'current_temperature_celsius' => 4.0,
            'temperature_breached' => false,
            'status' => 'In Storage'
        ]);

        // Update with out of range temp (PRBC safe is 2.0 to 6.0)
        $response = $this->postJson("/api/blood-bank/sensor/{$bag->bag_rfid}", [
            'temperature' => 8.5,
            'current_status' => 'In Storage'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['alert_triggered' => true]);

        $this->assertDatabaseHas('blood_bags', [
            'bag_rfid' => 'PRBC-123',
            'temperature_breached' => true,
        ]);
    }

    public function test_dispatch_is_blocked_for_unsafe_bags(): void
    {
        $bag = BloodBag::factory()->create([
            'bag_rfid' => 'BAD-BAG-1',
            'screening_status' => 'Failed', // Fails screening rule
            'temperature_breached' => false,
            'expiry_date' => now()->addDays(5)->toDateString(),
            'status' => 'In Storage'
        ]);

        $response = $this->postJson("/api/blood-bank/dispatch/{$bag->bag_rfid}");

        $response->assertStatus(403)
                 ->assertJsonFragment(['error' => '403 Forbidden: Bag cannot be issued due to safety rule violations.']);

        $this->assertDatabaseHas('blood_bags', [
            'bag_rfid' => 'BAD-BAG-1',
            'status' => 'In Storage', // Status should not change to Issued
        ]);
    }

    public function test_dispatch_succeeds_for_safe_bags(): void
    {
        $bag = BloodBag::factory()->create([
            'bag_rfid' => 'GOOD-BAG-1',
            'screening_status' => 'Passed',
            'temperature_breached' => false,
            'expiry_date' => now()->addDays(5)->toDateString(),
            'status' => 'In Storage'
        ]);

        $response = $this->postJson("/api/blood-bank/dispatch/{$bag->bag_rfid}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Bag dispatched successfully.']);

        $this->assertDatabaseHas('blood_bags', [
            'bag_rfid' => 'GOOD-BAG-1',
            'status' => 'Issued',
        ]);
    }
}
