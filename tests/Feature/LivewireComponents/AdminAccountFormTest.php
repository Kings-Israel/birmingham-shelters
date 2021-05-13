<?php

namespace Tests\Feature\LivewireComponents;

use App\Enums\UserTypeEnum;
use App\Events\AdminAccountRegistered;
use App\Models\User;
use App\Notifications\AdminAccountRegisteredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class AdminAccountFormTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_can_create_admin_account(): void
    {
        Notification::fake();

        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $component = Livewire::test('admin-account-form')
            ->assertSet('admin.user_type', UserTypeEnum::admin())
            ->set('admin.first_name', 'Test')
            ->set('admin.last_name', 'Admin')
            ->set('admin.email', $email = "admin@gmail.com")
            ->set('admin.phone_number', '444723457198')
            ->call('save_details');

        $component->assertHasNoErrors();

        $this->assertInstanceOf(User::class, $record = User::whereEmail($email)->first());

        $this->assertEquals(UserTypeEnum::admin(), $record->user_type);
        $this->assertEquals('Test', $record->first_name);
        $this->assertEquals('Admin', $record->last_name);

        $component->assertRedirect(route('admins.index'));

        $component->assertSessionHas('banner', 'Admin account created successfully.');
        $component->assertSessionHas('bannerStyle', 'success');

        Notification::assertSentTo($record, VerifyEmail::class);

        Notification::assertSentTo($record, AdminAccountRegisteredNotification::class);
    }

    public function test_ensures_a_valid_email_is_provided(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $component = Livewire::test('admin-account-form')
            ->assertSet('admin.user_type', UserTypeEnum::admin())
            ->set('admin.first_name', 'Test')
            ->set('admin.last_name', 'Admin')
            ->set('admin.email', 'invalidemail.com')
            ->set('admin.phone_number', '444723457198')
            ->call('save_details');

        $component->assertHasErrors('admin.email');
    }

    public function test_ensures_a_valid_phone_number_is_provided(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $component = Livewire::test('admin-account-form')
            ->assertSet('admin.user_type', UserTypeEnum::admin())
            ->set('admin.first_name', 'Test')
            ->set('admin.last_name', 'Admin')
            ->set('admin.email', 'admin@email.com')
            ->set('admin.phone_number', '4449483')
            ->call('save_details');

        $component->assertHasErrors('admin.phone_number');
    }

    public function test_ensures_unique_email_and_phone_number_is_provided(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        User::factory()->create([
            'email' => 'existing@mail.com',
            'phone_number' => '444723457198'
        ]);

        $component = Livewire::test('admin-account-form')
            ->assertSet('admin.user_type', UserTypeEnum::admin())
            ->set('admin.first_name', 'Test')
            ->set('admin.last_name', 'Admin')
            ->set('admin.email', 'existing@mail.com')
            ->set('admin.phone_number', '444723457198')
            ->call('save_details');

        $component->assertHasErrors(['admin.email', 'admin.phone_number']);

        $this->assertCount(1, User::whereEmail('existing@mail.com')->wherePhoneNumber('444723457198')->get());
    }

    public function test_can_edit_admin_record(): void
    {
        $this->actingAs(User::factory()->asUserType(UserTypeEnum::super_admin())->create());

        $existing_admin = User::factory()->asUserType(UserTypeEnum::admin())->create();

        $component = Livewire::test('admin-account-form', ['admin' => $existing_admin])
            ->assertSet('editingMode', true)
            ->assertSet('admin.first_name', $existing_admin->first_name)
            ->set('admin.first_name', 'UpdatedFirst')
            ->set('admin.last_name', 'UpdatedLast')
            ->call('save_details');

        $existing_admin->refresh();

        $this->assertSame('UpdatedFirst', $existing_admin->first_name);
        $this->assertSame('UpdatedLast', $existing_admin->last_name);

        $component->assertRedirect(route('admins.index'));

        $component->assertSessionHas('banner', 'Admin account updated successfully.');
        $component->assertSessionHas('bannerStyle', 'success');
    }


}
