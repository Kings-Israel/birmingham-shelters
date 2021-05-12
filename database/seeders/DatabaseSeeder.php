<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->asUserType(UserTypeEnum::super_admin())
            ->create([
                'email' => 'super_admin@mail.com',
                'first_name' => 'Super',
                'last_name' => 'Admin'
            ]);
    }
}
