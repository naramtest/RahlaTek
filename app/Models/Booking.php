<?php

namespace App\Models;

use App\Enums\Reservation\ReservationStatus;
use App\Models\Abstract\Payable;
use App\Traits\CheckStatus;
use App\Traits\HasReferenceNumber;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Money\Money;

class Booking extends Payable
{
    use CheckStatus;

    // TODO:add Notification
    //    use HasNotifications;
    use HasReferenceNumber;
    use SoftDeletes;

    protected $fillable = [
        'start_datetime',
        'end_datetime',
        'vehicle_id',
        'driver_id',
        'pickup_address',
        'destination_address',
        'status',
        'notes',
        'reference_number',
        'total_price',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'status' => ReservationStatus::class,
    ];

    /**
     * Get the vehicle that owns the booking.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the driver that owns the booking.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Calculate the total duration of the booking in days.
     */
    public function getDurationInDaysAttribute(): int
    {
        if (! $this->end_datetime || ! $this->start_datetime) {
            return 0;
        }

        return $this->start_datetime
            ->startOfDay()
            ->diffInDays($this->end_datetime->startOfDay()) + 1;
    }

    public function getFormattedDurationAttribute(): string
    {
        if (! $this->end_datetime || ! $this->start_datetime) {
            return '0 days';
        }

        // Get exact duration in hours
        $durationInHours = $this->start_datetime->diffInHours(
            $this->end_datetime
        );

        // Calculate days and remaining hours
        $days = floor($durationInHours / 24);
        $hours = $durationInHours % 24;

        if ($days == 0) {
            return $hours.' '.($hours == 1 ? 'hour' : 'hours');
        } elseif ($hours == 0) {
            return $days.' '.($days == 1 ? 'day' : 'days');
        } else {
            return $days.
                ' '.
                ($days == 1 ? 'day' : 'days').
                ' and '.
                $hours.
                ' '.
                ($hours == 1 ? 'hour' : 'hours');
        }
    }

    /**
     * Scope a query to only include bookings of a given status.
     */
    public function scopeStatus($query, ReservationStatus $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the addons attached to this booking.
     */
    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(Addon::class, 'booking_addon')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function getFormattedTotalPriceAttribute(): string
    {
        return $this->currencyService->format(
            $this->getTotalPriceMoneyAttribute(),
            app()->getLocale()
        );
    }

    public function getTotalPriceMoneyAttribute(): Money
    {
        return $this->currencyService->money($this->total_price);
    }

    public function getCustomer()
    {
        return $this->customer()->first();
    }

    // Helper method to get the single customer

    public function customer()
    {
        return $this->morphToMany(Customer::class, 'customerable')
            ->withTimestamps()
            ->limit(1); // Limit to one customer
    }

    protected function getReferenceNumberPrefix(): string
    {
        return 'BOK';
    }
}
