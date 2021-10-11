<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\result;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\result::factory(20)->create();
    }
}
