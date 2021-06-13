<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\ListingFeedback;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFeedbackFactory extends Factory
{

    protected $model = ListingFeedback::class;


    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence(10),
        ];
    }

    public function resolved(): Factory
    {
        return $this->state(['is_resolved' => true]);
    }

    public function addedBy(User $user): Factory
    {
        if (!$user->isAdministrator()) throw new Exception('User must an admin');

        return $this->state(['admin_id' => $user->id]);
    }

    public function setListing(Listing $listing): Factory
    {
        return $this->state(['listing_id' => $listing->id]);
    }
}
