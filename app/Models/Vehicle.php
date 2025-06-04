<?php

namespace App\Models;

use App\Enums\Vehicle\FuelType;
use App\Enums\Vehicle\GearboxType;
use App\Traits\Model\HasSoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Storage;

class Vehicle extends Model
{
    // TODO:has notification
    //    use HasNotifications;
    use HasSoftDeletes;

    protected $fillable = [
        'driver_id',
        'name',
        'type_id',
        'model',
        'engine_number',
        'engine_type',
        'license_plate',
        'registration_expiry_date',
        'currency_code',
        'year_of_first_immatriculation',
        'gearbox',
        'fuel_type',
        'number_of_seats',
        'kilometer',
        'options',
        'document',
        'notes',
        'inspection_period_days',
        'notify_before_inspection',
        'next_inspection_date',
    ];

    protected $casts = [
        'registration_expiry_date' => 'date',
        'next_inspection_date' => 'date',
        'gearbox' => GearboxType::class,
        'fuel_type' => FuelType::class,
        'kilometer' => 'integer',
        'options' => 'array',
        'notify_before_inspection' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::forceDeleted(function (Vehicle $vehicle) {
            if ($vehicle->document) {
                Storage::disk('public')->delete($vehicle->document);
            }
        });

        static::creating(function (Vehicle $vehicle) {
            if (empty($vehicle->next_inspection_date)) {
                $vehicle->next_inspection_date = now();
            }
        });
    }

    // TODO:add types
    //    public function types(): MorphToMany
    //    {
    //        return $this->morphToMany(Type::class, 'typeable')
    //            ->where('type', TypesEnum::VEHICLE)
    //            ->withTimestamps();
    //    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    //    public function bookings(): HasMany
    //    {
    //        return $this->hasMany(Booking::class);
    //    }

    //    public function inspections(): HasMany
    //    {
    //        return $this->hasMany(Inspection::class);
    //    }

    // Calculate days until next inspection

    public function getDaysUntilNextInspectionAttribute(): ?int
    {
        if (! $this->next_inspection_date) {
            return null;
        }

        return ceil(Carbon::now()->diffInDays($this->next_inspection_date));
    }
}
