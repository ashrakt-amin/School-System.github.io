<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
   
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'Date_Birth' =>$this->faker->randomElement(['1997','1998', '1999']),
            'gender_id' => $this->faker->numberBetween(1, 2),
            'nationalitie_id' => $this->faker->numberBetween(1, 20),
            'blood_id' =>$this->faker->numberBetween(1, 4),
            'Grade_id' => 1 ,
            'Classroom_id' => 1,
            'section_id' => 1,
            'parent_id' => $this->faker->numberBetween(1, 20),
            'academic_year'  =>$this->faker->randomElement(['2022','2023', '2024']),
        ];
    }
}
