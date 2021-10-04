<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\answer;
class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\answer::factory(100)->create();
    }
}
