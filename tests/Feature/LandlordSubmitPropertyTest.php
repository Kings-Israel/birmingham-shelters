<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandlordSubmitPropertyTest extends TestCase
{
    use RefreshDatabase;

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

        $data = Listing::factory()->make()
                    ->only([
                        'name',
                        'address',
                        'postcode',
                        'description',
                        'living_rooms',
                        'bedrooms',
                        'bathrooms',
                        'toilets',
                        'kitchen',
                        'contact_name',
                        'contact_email',
                        'contact_number',
                        'other_rooms',
                        'features',
                    ]);

        $data['other_rooms'] = null;
        $data['features'] = $data['features']->all();

        $response = $this->post(route('listing.add.submit_basic_info'), $data);

        $listing = Listing::first();

        $this->assertNotNull($listing);
        $this->assertSame($data['name'], $listing->name);

        $response->assertRedirect(route('listing.add.client_info', $listing->id));
    }

    public function test_property_add_basic_info_submission_parses_other_rooms_correctly(): void
    {
        $this->actingAs($user = User::factory()->asUserType('landlord')->create());

        $data = Listing::factory()->make()
                    ->only([
                        'name',
                        'address',
                        'postcode',
                        'description',
                        'living_rooms',
                        'bedrooms',
                        'bathrooms',
                        'toilets',
                        'kitchen',
                        'contact_name',
                        'contact_email',
                        'contact_number',
                        'other_rooms',
                        'features',
                    ]);

        $data['other_rooms'] = "Basement, Pantry";
        $data['features'] = $data['features']->all();

        $response = $this->post(route('listing.add.submit_basic_info'), $data);

        $this->assertNotNull($listing = Listing::first());
        $this->assertSame($data['name'], $listing->name);
        $this->assertEquals(['Basement', 'Pantry'], $listing->other_rooms->all());

        $response->assertRedirect(route('listing.add.client_info', $listing->id));
    }

}
