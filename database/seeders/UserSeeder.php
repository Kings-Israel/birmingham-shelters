<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Listing;
use App\Models\ListingDocument;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class UserSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

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
                    'email' => $type.'@test.com',
                ]);
            });

        Listing::factory(10)
            ->withDocuments()
            ->ownerAs(User::whereEmail('landlord@test.com')->first())
            ->create();

        User::factory()->create([
            'user_type' => 'user',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
        ]);

        User::factory()->create([
            'user_type' => 'agent',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
        ]);

        User::factory()->create([
            'user_type' => 'landlord',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
        ]);

    }
}
