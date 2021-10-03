<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'text' => $this->faker->text,
                'person_data_processing_agree'=>$this->faker->boolean()
        ];
    }
}
