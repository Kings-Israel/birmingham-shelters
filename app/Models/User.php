<?php

namespace App\Models;

use App\Enums\UserTypeEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    /**
     * Get all of the document for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function document()
    {
        return $this->hasMany(Document::class);
    }
}
