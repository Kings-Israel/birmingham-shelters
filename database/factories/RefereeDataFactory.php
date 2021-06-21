<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\RefereeData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class RefereeDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefereeData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected bool $with_referee_data_info = true;

    protected bool $with_address_info = true;

    protected bool $with_health_info = true;

    protected bool $with_income_info = true;

    protected bool $with_risk_assessment = true;

    protected bool $with_support_needs_info = true;

    public function definition()
    {
        $user = User::where('user_type', '=', 'agent')->pluck('id')->toArray();
        return collect([])
            ->when($this->with_referee_data_info, function (Collection $attributes) {
                return $attributes->merge([
                    'user_id' => $this->faker->randomElements(User::where('user_type', '=', 'agent')->pluck('id')->toArray()),
                    'referral_type' => 'Agency Referral',
                    'referrer_name' => $this->faker->name(),
                    'referrer_email' => $this->faker->email(),
                    'referrer_phone_number' => $this->faker->unique()->regexify('44\d{10}'),
                    'referral_reason' => $this->faker->text(60),
                    'applicant_name' => $this->faker->name(),
                    'applicant_email' => $this->faker->email(),
                    'applicant_phone_number' => $this->faker->unique()->regexify('44\d{10}'),
                    'applicant_date_of_birth' => $this->faker->date(),
                    'applicant_ni_number' => $this->faker->numberBetween(1, 10000),
                    'applicant_current_address' => $this->faker->streetAddress(),
                    'applicant_gender' => $this->faker->randomElements([
                        'Male', 'Female'
                    ], 1),
                    'applicant_sexual_orientation' => $this->faker->randomElements([
                        'Men', 'Women'
                    ], 1),
                    'applicant_ethnicity' => $this->faker->randomElements([
                        'African', 'American', 'Asian', 'Arabian'
                    ], 1),
                    'applicant_kin_name' => $this->faker->name(),
                    'applicant_kin_email' => $this->faker->email(),
                    'applicant_kin_phone_number' => $this->faker->unique()->regexify('44\d{10}'),
                    'applicant_kin_relationship' => $this->faker->randomElements([
                        'Father', 'Mother', 'Sister', 'Brother', 'Cousin'
                    ], 1),
                    'consent' => true
                ]);
            })->all();
    }
}
