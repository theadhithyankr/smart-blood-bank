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
        
        return [
            'bag_rfid' => 'BAG-' . $this->faker->unique()->randomNumber(8, true),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'component_type' => $this->faker->randomElement($components),
            'is_screened' => true,
            'screening_status' => $this->faker->randomElement(['Pending', 'Passed', 'Passed', 'Failed']),
            'current_temperature_celsius' => $this->faker->randomFloat(1, 2.0, 6.0),
            'temperature_breached' => false,
            'expiry_date' => $this->faker->dateTimeBetween('-10 days', '+30 days')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['In Storage', 'In Storage', 'In Transit', 'Issued']),
        ];
    }
}
