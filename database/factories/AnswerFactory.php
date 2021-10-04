<?php

namespace Database\Factories;

use App\Models\answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>rand(1,10),
            'question_id'=>rand(1,10),
            'answer'=>'answer'.rand(1,4)
        ];
    }
}
