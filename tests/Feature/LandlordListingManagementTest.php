<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
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

        $this->get(route('listing.view.one', $listing->id))
                ->assertOk()
                ->assertViewHas('listing', $listing);
    }

    public function test_landlord_can_delete_listing(): void
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $listing = Listing::factory()->ownerAs($user)->withDocuments()->create();

        $listing->load('documents');

        $this->delete(route('listing.delete', $listing->id))
            ->assertRedirect(route('listing.view.all'))
            ->assertSessionHas('success', 'Listing has been deleted successfully');

        $this->assertTrue($listing->fresh()->trashed());

        $listing->images
            ->each(fn ($path) => $this->assertTrue(Storage::disk('listing')->missing('images/'.$path)));

        $listing->documents->pluck('filename')
            ->each(fn ($path) => $this->assertTrue(Storage::disk('listing')->missing('documents/'.$path)));

        $this->assertDatabaseMissing('listing_documents', ['listing_id' => $listing->id]);
    }

    public function test_landlord_can_only_delete_their_listing(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $listing = Listing::factory()->withRelationships()->create();

        $this->delete(route('listing.delete', $listing->id))
            ->assertStatus(403);

        $this->assertFalse($listing->fresh()->trashed());
    }
}
