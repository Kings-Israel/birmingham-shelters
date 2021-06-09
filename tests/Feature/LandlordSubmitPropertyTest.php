<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LandlordSubmitPropertyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_property_add_basic_info_form_can_be_viewed(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $this->get(route('listing.add.basic_info'))
            ->assertOk()
            ->assertViewHas('features');
    }

    public function test_property_add_basic_info_submission(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();

        $data['other_rooms'] = '';

        $response = $this->post(route('listing.add.submit_basic_info'), $data);

        $this->assertNotNull($listing = Listing::first());
        $this->assertSame($data['name'], $listing->name);

        $response->assertRedirect(route('listing.add.client_info', $listing->id));
    }

    public function test_property_add_basic_info_submission_parses_other_rooms_correctly(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();

        $data['other_rooms'] = 'Basement, Pantry';

        $response = $this->post(route('listing.add.submit_basic_info'), $data);

        $this->assertNotNull($listing = Listing::first());
        $this->assertSame($data['name'], $listing->name);
        $this->assertEquals(['Basement', 'Pantry'], $listing->other_rooms->all());

        $response->assertRedirect(route('listing.add.client_info', $listing->id));
    }

    public function test_property_add_client_info_form_can_be_viewed(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();

        $data['other_rooms'] = '';

        $listing = Auth::user()->listings()->create($data);

        $this->withExceptionHandling();

        $this->get(route('listing.add.client_info', $listing->id))
            ->assertOk()
            ->assertViewHasAll(['id', 'supported_groups']);
    }

    public function test_property_add_client_info_form_can_be_viewed_only_by_owner(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();

        $data['other_rooms'] = '';

        $listing = User::factory()->asUserType('landlord')->create()->listings()->create($data);

        $this->get(route('listing.add.client_info', $listing->id))
            ->assertStatus(403);
    }

    public function test_property_add_client_info_submission(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();

        $data['other_rooms'] = '';

        /** @var Listing */
        $listing = User::factory()->asUserType('landlord')->create()->listings()->create($data);

        $client_data = [
            'listing_id' => $listing->id,
            'supported_groups' => ['Mental Health', 'Homeless'],
            'support_description' => $this->faker->paragraph(6),
            'support_hours' => 3,
        ];

        $this->post(route('listing.add.submit_client_info'), $client_data)
            ->assertRedirect(route('listing.add.listing_documents', $listing->id));

        $listing->refresh();

        $this->assertEquals($client_data['supported_groups'], $listing->supported_groups);
        $this->assertEquals($client_data['support_description'], $listing->support_description);
        $this->assertEquals($client_data['support_hours'], $listing->support_hours);
    }

    public function test_property_add_client_info_submission_other_types_is_required_when_other_is_checked(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();
        $data['other_rooms'] = '';

        /** @var Listing */
        $listing = User::factory()->asUserType('landlord')->create()->listings()->create($data);

        $client_data = [
            'listing_id' => $listing->id,
            'supported_groups' => ['Mental Health', 'Homeless', 'Other'],
            'support_description' => $this->faker->paragraph(6),
            'support_hours' => 3,
        ];

        $this->post(route('listing.add.submit_client_info'), $client_data)
            ->assertSessionHasErrors('other_supported_groups');
    }

    public function test_property_add_client_info_submission_correctly_merges_in_other_supported_groups(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->basicInfoOnly()->make()->toArray();
        $data['other_rooms'] = '';

        /** @var Listing */
        $listing = User::factory()->asUserType('landlord')->create()->listings()->create($data);

        $client_data = [
            'listing_id' => $listing->id,
            'supported_groups' => ['Mental Health', 'Homeless', 'Other'],
            'other_supported_groups' => "Visually Impaired",
            'support_description' => $this->faker->paragraph(6),
            'support_hours' => 3,
        ];

        $this->post(route('listing.add.submit_client_info'), $client_data)
            ->assertRedirect(route('listing.add.listing_documents', $listing->id));

        $listing->refresh();

        $this->withoutExceptionHandling();

        $excepted_supported_groups = collect($client_data['supported_groups'])
            ->reject(fn($value) => $value === "Other")
            ->merge(
                collect(explode(',', $client_data['other_supported_groups']))->map(fn ($value) => trim($value))
                )->all();

        $this->assertEquals($excepted_supported_groups, $listing->supported_groups);
        $this->assertEquals($client_data['support_description'], $listing->support_description);
        $this->assertEquals($client_data['support_hours'], $listing->support_hours);
    }
}
