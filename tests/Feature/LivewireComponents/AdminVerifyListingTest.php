<?php

namespace Tests\Feature\LivewireComponents;

use App\Http\Livewire\AdminVerifyListing;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminVerifyListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_mark_listing_as_verified(): void
    {
        $this->actingAs(User::factory()->asUserType('admin')->create());

        /** @var Listing */
        $listing = Listing::factory()->withRelationships()->create();

        $component = Livewire::test(AdminVerifyListing::class, ['listing' => $listing])
                        ->assertSet('listing', $listing)
                        ->assertSee('Verify Listing')
                        ->call('markAsVerified')
                        ->assertSee('Verified');

        $listing->refresh();

        $this->assertTrue($listing->is_verified);
    }

    public function test_only_authorized_users_can_mark_listing_as_verified(): void
    {
        $this->actingAs(User::factory()->asUserType('landlord')->create());

        /** @var Listing */
        $listing = Listing::factory()->withRelationships()->create();

        Livewire::test(AdminVerifyListing::class, ['listing' => $listing])
                        ->call('markAsVerified')
                        ->assertStatus(403);

        $listing->refresh();

        $this->assertFalse($listing->is_verified);
    }
}
