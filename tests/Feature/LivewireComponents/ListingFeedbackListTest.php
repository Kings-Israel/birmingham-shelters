<?php

namespace Tests\Feature\LivewireComponents;

use App\Enums\ListingStatusEnum;
use App\Http\Livewire\ListingFeedbackList;
use App\Models\Listing;
use App\Models\ListingFeedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class ListingFeedbackListTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_empty_message_with_no_feedback_items(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        /** @var Listing */
        $listing = Listing::factory()->ownerAs($user)->withDocuments()->create();

        $this->assertEquals(0, $listing->listing_feedback_count);

        Livewire::test(ListingFeedbackList::class, ['listing' => $listing])
            ->assertSet('listing.id', $listing->id)
            ->assertSee('No feedback has been provided yet.');
    }

    public function test_displays_list_when_not_empty(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        /** @var Listing */
        $listing = Listing::factory()->ownerAs($user)->withDocuments()->create();

        $listing->listingFeedback()->saveMany(
            ListingFeedback::factory(5)
                ->forAdmin()
                ->make()
        );

        $this->assertDatabaseCount('listing_feedback', 5);

        $feedback = ListingFeedback::first();

        Livewire::test(ListingFeedbackList::class, ['listing' => $listing])
            ->assertDontSee('No feedback has been provided yet.')
            ->assertSee($feedback->message);
    }

    public function test_only_landlord_can_view_mark_as_read_action(): void
    {
        $this->actingAs($user = User::factory()->asUserType('admin')->create());

        /** @var Listing */
        $listing = Listing::factory()->withRelationships()->create();

        $listing->listingFeedback()->saveMany(
            ListingFeedback::factory(2)
                ->forAdmin()
                ->make()
        );

        $this->assertDatabaseCount('listing_feedback', 2);

        Livewire::test(ListingFeedbackList::class, ['listing' => $listing])
            ->assertDontSee('Mark as resolved');
    }

    public function test_landlord_can_mark_feedback_as_resolved(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        /** @var Listing */
        $listing = Listing::factory()->ownerAs($user)->withDocuments()->create();

        $feedback = $listing->listingFeedback()->save(
            ListingFeedback::factory()->forAdmin()->make()
        );

        $this->assertDatabaseCount('listing_feedback', 1);

        Livewire::test(ListingFeedbackList::class, ['listing' => $listing])
            ->assertSee("Mark as resolved")
            ->call("markAsResolved", $feedback->id)
            ->assertDontSee("Mark as resolved");

        $this->assertTrue($feedback->fresh()->is_resolved);
    }

    public function test_changes_listing_status_to_pending_when_all_comments_are_resolved(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        /** @var Listing */
        $listing = Listing::factory()->ownerAs($user)->withDocuments()->create();

        /** @var Collection */
        $feedbackList = $listing->listingFeedback()->saveMany(
            ListingFeedback::factory(2)
                ->state(new Sequence(
                    ['is_resolved' => true],
                    ['is_resolved' => false]
                ))
                ->forAdmin()->make()
        );

        Livewire::test(ListingFeedbackList::class, ['listing' => $listing])
            ->call("markAsResolved", $feedbackList->last()->id)
            ->assertDontSee("Mark as resolved");

        $this->assertEquals(ListingStatusEnum::pending(), $listing->fresh()->status);
    }

}
