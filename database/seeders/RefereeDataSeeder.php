<?php

namespace Database\Seeders;

use App\Models\RefereeData;
use Illuminate\Database\Seeder;

class RefereeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefereeData::factory()->create();
    }
}
