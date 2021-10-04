<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Question;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        \App\Models\Question::factory($count)->create();
    }
}
