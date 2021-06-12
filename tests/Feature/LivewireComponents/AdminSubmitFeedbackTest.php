<?php

namespace Tests\Feature\LivewireComponents;

use App\Enums\ListingStatusEnum;
use App\Http\Livewire\AdminSubmitFeedback;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class AdminSubmitFeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_submit_listing_feedback(): void
    {
        $this->actingAs($admin = User::factory()->asUserType('admin')->create());

        $listing = Listing::factory()->withRelationships()->create();

        Livewire::test(AdminSubmitFeedback::class, ['listing' => $listing])
                ->assertSet('feedback.listing_id', $listing->id)
                ->assertSet('feedback.admin_id', $admin->id)
                ->set('feedback.message', $message = "Update your images to match property")
                ->call('submitFeedback')
                ->assertHasNoErrors()
                ->assertEmitted('feedbackSubmitted')
                ->assertSet('feedback.message', '');

        $this->assertDatabaseHas('listing_feedback', [
            'listing_id' => $listing->id,
            'admin_id' => $admin->id,
            'message' => $message,
        ]);

        $listing->refresh();

        $this->assertEquals(ListingStatusEnum::needs_review(), $listing->status);
    }

    public function test_only_administrators_can_submit_listing_feedback(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $listing = Listing::factory()->withRelationships()->create();

        Livewire::test(AdminSubmitFeedback::class, ['listing' => $listing])
                ->set('feedback.message', $message = "Update your images to match property")
                ->call('submitFeedback')
                ->assertStatus(403)
                ->assertNotEmitted('feedbackSubmitted');

        $this->assertDatabaseMissing('listing_feedback', [
            'listing_id' => $listing->id,
            'admin_id' => $user->id,
            'message' => $message,
        ]);
    }
}
