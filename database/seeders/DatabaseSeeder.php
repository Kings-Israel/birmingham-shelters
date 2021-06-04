<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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

        User::factory()->asUserType(UserTypeEnum::agent())
            ->create([
                'email' => 'agent@test.com',
                'first_name' => 'Agent',
                'last_name' => 'Test'
            ]);

        User::factory()->asUserType(UserTypeEnum::user())
            ->create([
                'email' => 'user@test.com',
                'first_name' => 'Referee',
                'last_name' => 'Test'
            ]);
    }
}
