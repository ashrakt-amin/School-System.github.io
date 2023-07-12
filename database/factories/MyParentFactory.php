<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MyParent>
 */
class MyParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'email' =>$this->faker->unique()->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'Name_Father' => $this->faker->name(),
                'National_ID_Father' => $this->faker->unique()->phoneNumber(),
                'Passport_ID_Father' => $this->faker->unique()->phoneNumber(),
                'Phone_Father' => $this->faker->unique()->phoneNumber(),
                'Job_Father' => 'engineer',
                'Nationality_Father_id' => $this->faker->numberBetween(1, 20),
                'Blood_Type_Father_id' => $this->faker->numberBetween(1, 4),
                'Religion_Father_id' => $this->faker->numberBetween(1, 3),
                'Address_Father' => $this->faker->name(),
                'Name_Mother' => $this->faker->name(),
                'National_ID_Mother' => $this->faker->unique()->phoneNumber(),
                'Passport_ID_Mother' => $this->faker->unique()->phoneNumber(),
                'Phone_Mother' => $this->faker->unique()->phoneNumber(),
                'Job_Mother' => 'engineer',
                'Nationality_Mother_id'=>  $this->faker->numberBetween(1, 20),
                'Blood_Type_Mother_id'=> $this->faker->numberBetween(1, 4),
                'Religion_Mother_id'=>  $this->faker->numberBetween(1, 3),
                'Address_Mother'=> $this->faker->name(),
    
    
            ];
        }
    }
    
