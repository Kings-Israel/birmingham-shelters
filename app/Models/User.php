<?php

namespace App\Models;

use App\Enums\UserTypeEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'user_type',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'user_type' => UserTypeEnum::class,
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime',
    ];

    public function scopeAdmins(Builder $query): Builder
    {
        return $query->whereUserType(UserTypeEnum::admin()->value);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name." ".$this->last_name;
    }

    public function isEmailVerified(): bool
    {
        return isset($this->email_verified_at);
    }

    public function isPhoneNumberVerified(): bool
    {
        return isset($this->phone_number_verified_at);
    }

    public function isAdministrator(): bool
    {
        return in_array($this->user_type, [UserTypeEnum::admin(), UserTypeEnum::super_admin()]);
    }

    /**
     * @param UserTypeEnum|string $user_type
     * @return bool
     */
    public function isOfType($user_type): bool
    {
        if (is_string($user_type)) {
            $user_type = UserTypeEnum::from($user_type);
        }

        return $this->user_type === $user_type;
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function refereedata()
    {
        return $this->hasMany(RefereeData::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
