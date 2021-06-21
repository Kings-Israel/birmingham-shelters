<?php

namespace Database\Factories;

use App\Models\ListingInquiry;
use Spatie\Enum\Laravel\Faker\FakerEnumProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingInquiryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListingInquiry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_name' => $this->faker->name(),
            'user_email' => $this->faker->email(),
            'user_phone_number' => $this->faker->unique()->regexify('44\d{10}'),
            'listing_message' => $this->faker->text(70),
        ];
    }

    public function ownerAs(Listing $listing): Factory
    {
        return $this->state(fn ($attributes) => ['listing_id' => $listing->id]);
    }
}
