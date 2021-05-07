<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Faker\FakerEnumProvider;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        FakerEnumProvider::register();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->unique()->regexify('44\d{10}'),
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'user_type' => $this->faker->randomEnumValue(UserTypeEnum::class),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address and phone number should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
                'phone_number_verified_at' => null,
            ];
        });
    }

    public function asUserType(UserTypeEnum $userType): Factory
    {
        return $this->state(function (array $attributes) use ($userType) {
            return [
                'user_type' => $userType->value,
            ];
        });
    }
}
