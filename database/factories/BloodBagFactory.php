<?php

namespace Database\Factories;

use App\Models\BloodBag;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodBagFactory extends Factory
{
    protected $model = BloodBag::class;

    public function definition(): array
    {
        $components = ['Whole Blood', 'Packed Red Blood Cells', 'Platelets', 'Fresh Frozen Plasma'];
        
        // 10% chance to simulate a temperature breach
        $isBreached = $this->faker->boolean(10);
        $component = $this->faker->randomElement($components);
        
        $temp = 4.0; // Default safe PRBC
        if ($component === 'Platelets') {
            $temp = 22.0;
        }

        if ($isBreached) {
            $temp = $component === 'Platelets' ? 26.5 : 8.5; // Simulate unsafe temps
        }

        return [
            'bag_rfid' => 'BAG-' . strtoupper($this->faker->unique()->bothify('??####??')),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'component_type' => $component,
            'is_screened' => true,
            'screening_status' => $this->faker->randomElement(['Pending', 'Passed', 'Passed', 'Passed', 'Failed']),
            'current_temperature_celsius' => $temp,
            'temperature_breached' => $isBreached,
            'expiry_date' => $this->faker->dateTimeBetween('now', '+15 days')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['In Storage', 'In Storage', 'In Storage', 'In Transit', 'Issued']),
        ];
    }
}
