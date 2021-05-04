<?php

namespace Tests\Feature\LivewireComponents;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminAccountFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_admin_account(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        // TODO: start here

        Livewire::test('admin-account-form')
            ->assertSet('admin.user_type', UserTypeEnum::admin())
            ->set('admin.first_name', '')
            ->set('admin.last_name', '')
            ->set('admin.email', '')
            ->set('admin.phone_number', '')
            ->call('create_account');

        // assert record exists

        // assert user type is admin

        // assert redirect to table page

        // assert flash success message

        // assert email verification notification event dispatched

        // assert phone number verificaiton notification event dispatched
    }
}
