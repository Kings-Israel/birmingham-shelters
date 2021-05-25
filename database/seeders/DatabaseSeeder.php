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

        User::factory()->asUserType(UserTypeEnum::admin())
            ->create([
                'email' => 'admin@test.com',
                'first_name' => 'Admin',
                'last_name' => 'Test'
            ]);

        User::factory()->asUserType(UserTypeEnum::landlord())
            ->create([
                'email' => 'landlord@test.com',
                'first_name' => 'Landlord',
                'last_name' => 'Test'
            ]);

        User::factory()->asUserType(UserTypeEnum::volunteer())
            ->create([
                'email' => 'volunteer@test.com',
                'first_name' => 'Volunteer',
                'last_name' => 'Test'
            ]);
    }
}
