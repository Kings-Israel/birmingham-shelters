<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Faker\FakerEnumProvider;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition(): array
    {
        FakerEnumProvider::register();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->freeEmail(),
            'phone_number' => $this->faker->unique()->regexify('44\d{10}'),
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'user_type' => $this->faker->randomEnumValue(UserTypeEnum::class),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
                'phone_number_verified_at' => null,
            ];
        });
    }

    public function asUserType($user_type): Factory
    {
        if (is_string($user_type)) {
            $user_type = UserTypeEnum::from($user_type);
        }

        return $this->state(function (array $attributes) use ($user_type) {
            return [
                'user_type' => $user_type->value,
            ];
        });
    }
}
