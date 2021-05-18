<?php

namespace Tests\Feature\LivewireComponents;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire;
use Tests\TestCase;

class ChangePasswordFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_password(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test('change-password-form')
            ->set('current_password', 'password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('save');

        $component->assertHasNoErrors();
        $component->assertEmitted('saved');

        $user->refresh();

        $this->assertTrue(Hash::check('new-password', $user->password));
    }

    public function test_current_password_is_validated(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test('change-password-form')
            ->set('current_password', 'wrong-password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('save');

        $component->assertHasErrors(['current_password']);
    }
}
