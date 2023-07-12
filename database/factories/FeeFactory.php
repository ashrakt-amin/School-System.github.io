<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fee>
 */
class FeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'        =>  $this->faker->name(),
            'amount'       =>  $this->faker->numberBetween(1000, 2000) ,
            'year'         =>  $this->faker->numberBetween(2019, 2020),
            'description'  =>  $this->faker->paragraph(),
            'type_id'     =>  $this->faker->numberBetween(1, 2),
            'Grade_id'     =>  $this->faker->numberBetween(1, 2),
            'Classroom_id' =>  $this->faker->numberBetween(1, 2),
        ];
       
    }
}
