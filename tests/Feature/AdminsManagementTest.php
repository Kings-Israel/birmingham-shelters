<?php

namespace Tests\Feature;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_view_form(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $this->get(route('admins.create'))
            ->assertOk();
    }

    public function test_admin_account_form_component_exists_in_admin_creation_view(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $this->get(route('admins.create'))
            ->assertSeeLivewire('admin-account-form');
    }
}
