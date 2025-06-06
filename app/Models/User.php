<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LogicException;
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

    public function tenant(): BelongsTo
    {
        if (tenancy()->initialized) {
            throw new LogicException(
                'Tenant relationship not available in tenant context'
            );
        }

        return $this->belongsTo(Tenant::class);
    }

    public function hasTenant(): bool
    {
        if (tenancy()->initialized) {
            return false;
        }

        return ! is_null($this->tenant_id);
    }

    /**
     * Check if the user is a driver
     */
    public function isDriver(): bool
    {
        return $this->driver()->exists();
    }

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }
}
