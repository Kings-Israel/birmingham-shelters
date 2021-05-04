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
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::admin())->create());

        $this->get(route('admins.create'))
            ->assertOk();
    }
}
