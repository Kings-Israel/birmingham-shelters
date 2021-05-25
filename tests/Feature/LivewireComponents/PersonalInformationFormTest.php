<?php

namespace Tests\Feature\LivewireComponents;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PersonalInformationFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_is_initialised_with_current_authenticated_user(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test('personal-information-form')
            ->assertSet('user.first_name', $user->first_name)
            ->assertSet('user.last_name', $user->last_name)
            ->assertSet('user.email', $user->email);
    }

    public function test_user_can_update_personal_information(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test('personal-information-form')
            ->set('user.first_name', 'FirstName')
            ->set('user.last_name', 'LastName')
            ->call('save_changes');

        $component->assertEmitted('saved');

        $user->refresh();

        $this->assertSame('FirstName', $user->first_name);
        $this->assertSame('LastName', $user->last_name);
    }


}
