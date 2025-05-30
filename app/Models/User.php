<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// TODO: add email verification
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tenant(): HasOne
    {
        if (tenancy()->initialized) {
            throw new \LogicException(
                'Tenant relationship not available in tenant context'
            );
        }

        return $this->hasOne(Tenant::class);
    }
}
