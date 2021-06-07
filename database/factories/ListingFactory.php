<?php

namespace Database\Factories;

use App\Enums\ListingProofsEnum;
use App\Models\Listing;
use App\Models\ListingDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'address' => $this->faker->streetAddress(),
            'postcode' => $this->faker->postcode(),
            'description' => $this->faker->paragraph(),
            'living_rooms' => $this->faker->numberBetween(0, 3),
            'bedrooms' => $this->faker->numberBetween(1, 4),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'toilets' => $this->faker->numberBetween(1, 3),
            'kitchen' => $this->faker->numberBetween(1, 3),
            'features' => $this->getFeatures(),
            'other_rooms' => [],
            'verified_at' => now(),
            'is_available' => true,
            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->freeEmail(),
            'contact_number' => $this->faker->unique()->regexify('44\d{10}'),
            'supported_groups' => $this->getSupportedGroups(),
            'support_description' => $this->faker->paragraph(7),
            'support_hours' => $this->faker->numberBetween(1, 4),
            'images' => $this->setSampleImages(),
            'proofs' => $this->setProofs(),
        ];
    }

    protected function getFeatures(): array
    {
        return $this->faker->randomElements(
            [
                'Air Condition',
                'Internet',
                'Garden',
                'Bedding',
                'Microwave',
                'Balcony',
                'Central Heating',
                'Parking',
                'Pre-Payment Meters',
            ],
            $this->faker->numberBetween(2, 8)
        );
    }

    protected function getSupportedGroups(): array
    {
        return $this->faker->randomElements([
            'Mental Health',
            'Homeless',
            'Drug Dependency',
            'Alcohol Dependency',
            'Learning Disability',
        ], 3);
    }

    protected function setSampleImages(): array
    {
        return [
            'samples/sample_1.jpg',
            'samples/sample_2.jpg',
            'samples/sample_3.jpg',
        ];
    }

    protected function setProofs(): array
    {
        return $this->faker->randomElements(
            ListingProofsEnum::toValues(),
            $this->faker->numberBetween(0, 3)
        );
    }

    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'verified_at' => null,
            ];
        });
    }

    public function unavailable(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_available' => false,
            ];
        });
    }
}
