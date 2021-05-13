<?php

namespace Tests\Feature;

use App\Enums\UserTypeEnum;
use App\Http\Livewire\DeleteUserModal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteUserModalTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_delete_admin_account(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $admin_user = User::factory()->asUserType(UserTypeEnum::admin())->create();

        $component = Livewire::test(DeleteUserModal::class, ['redirect_route_name' => 'admins.index'])
            ->set('user_id', $admin_user->id)
            ->call('delete');

        $this->assertNull(User::find($admin_user->id));

        $component->assertRedirect(route('admins.index'));

        $component->assertSessionHas('banner', 'Account deleted successfully.');
        $component->assertSessionHas('bannerStyle', 'success');
    }

    public function test_other_users_cannot_delete_user_accounts(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::volunteer())->create());

        $admin_user = User::factory()->asUserType(UserTypeEnum::admin())->create();

        $component = Livewire::test(DeleteUserModal::class, ['redirect_route_name' => 'admins.index'])
            ->set('user_id', $admin_user->id)
            ->call('delete');

        $component->assertStatus(403);

        $this->assertNotNull(User::find($admin_user->id));
    }


}
