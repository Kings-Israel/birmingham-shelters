<?php

namespace Tests\Feature\Admin;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_all_listings(): void
    {
        $this->actingAs(User::factory()->asUserType('admin')->create());

        Listing::factory(3)->withRelationships()->create();

        $this->assertDatabaseCount('listings', 3);

        $this->get(route('admin.listings.index'))
            ->assertOk();
    }

    public function test_admin_can_visit_single_listing(): void
    {
        $this->actingAs(User::factory()->asUserType('admin')->create());

        $listing = Listing::factory()->withRelationships()->create();

        $this->get(route('admin.listings.show', $listing->id))
            ->assertOk();
    }
}
