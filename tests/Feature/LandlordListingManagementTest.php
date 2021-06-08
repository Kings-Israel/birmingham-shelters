<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandlordListingManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_landlord_can_visit_all_properties_endpoint(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        Listing::factory(5)->ownerAs($user)->withDocuments()->create();

        $this->get(route('listing.view.all'))
            ->assertOk()
            ->assertViewHas('listings');
    }

    public function test_landlord_can_view_single_listing(): void
    {
        $this->actingAs(User::factory()->asUserType('landlord')->create());

        $listing = Listing::factory()->withRelationships()->create();

        $this->withoutExceptionHandling();

        $this->get(route('listing.view.one', $listing->id))
                ->assertOk()
                ->assertViewHas('listing', $listing);
    }
}
