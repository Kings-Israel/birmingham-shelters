<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->asUserType(UserTypeEnum::super_admin())
            ->create([
                'email' => 'super_admin@mail.com',
                'first_name' => 'Super',
                'last_name' => 'Admin'
            ]);

        collect(UserTypeEnum::toValues())
            ->reject(fn ($value) => $value === 'super_admin')->each(function ($type) {
                User::factory()->create([
                    'user_type' => $type,
                    'first_name' => ucfirst($type),
                    'last_name' => 'Test',
                    'email' => "$type@test.com",
                ]);
            });
    }
}
