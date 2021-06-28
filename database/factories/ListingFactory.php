<?php

namespace Database\Factories;

use App\Enums\ListingProofsEnum;
use App\Enums\ListingStatusEnum;
use App\Models\Listing;
use App\Models\ListingDocument;
use App\Models\User;
use App\Models\ListingInquiry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    protected bool $with_basic_info = true;

    protected bool $with_support_info = true;

    protected bool $with_images = true;

    public function definition(): array
    {
        return collect([])
            ->when($this->with_basic_info, function (Collection $attributes) {
                return $attributes->merge([
                    'name' => $this->faker->sentence(4),
                    'assessment_date' => $this->faker->date('Y-m-d'),
                    'address' => $this->faker->streetAddress(),
                    'postcode' => $this->faker->postcode(),
                    'description' => $this->faker->paragraph(),
                    'living_rooms' => $this->faker->numberBetween(0, 3),
                    'bedrooms' => $this->faker->numberBetween(1, 4),
                    'bathrooms' => $this->faker->numberBetween(1, 3),
                    'available_rooms' => $this->faker->numberBetween(1, 5),
                    'toilets' => $this->faker->numberBetween(1, 3),
                    'kitchen' => $this->faker->numberBetween(1, 3),
                    'features' => $this->getFeatures(),
                    'other_rooms' => 'Home Office',
                    'contact_name' => $this->faker->name(),
                    'contact_email' => $this->faker->freeEmail(),
                    'contact_number' => $this->faker->unique()->regexify('44\d{10}'),
                ]);
            })
            ->when($this->with_support_info, function (Collection $attributes) {
                return $attributes->merge([
                    'supported_groups' => $this->getSupportedGroups(),
                    'support_description' => $this->faker->paragraph(7),
                    'support_hours' => $this->faker->numberBetween(1, 4),
                ]);
            })
            ->when($this->with_images, function (Collection $attributes) {
                return $attributes->merge([
                    'images' => $this->setSampleImages(),
                    'status' => ListingStatusEnum::pending()
                ]);
            })
            ->all();
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

    public function setProofs(): Factory
    {
        return $this->state([
            'proofs' => $this->faker->randomElements(ListingProofsEnum::toValues(), $this->faker->numberBetween(0, 3)),
        ]);
    }

    public function verified(): Factory
    {
        return $this->state(['status' => ListingStatusEnum::verified()]);
    }

    public function unavailable(): Factory
    {
        return $this->state(['is_available' => false ]);
    }

    public function ownerAs(User $user): Factory
    {
        return $this->state(fn ($attributes) => ['user_id' => $user->id]);
    }

    public function withDocuments(): Factory
    {
        return $this->setProofs()
                    ->has(ListingDocument::factory()->requiredDocuments(), 'documents');
    }

    public function withRelationships(): Factory
    {
        return $this->forUser()->withDocuments();
    }

    public function withInquiries(): Factory
    {
        return $this->has(ListingInquiry::factory(3), 'inquiry');
    }

    public function basicInfoOnly(): Factory
    {
        $this->with_images = false;
        $this->with_support_info = false;

        return $this;
    }
}
