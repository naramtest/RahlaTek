<?php

namespace App\Models;

use App\Enums\Reservation\BillingType;
use App\Models\Abstract\MoneyModel;
use Money\Money;
use Spatie\Translatable\HasTranslations;

class Addon extends MoneyModel
{
    use HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'price',
        'currency_code',
        'billing_type',
        'description',
        'is_active',
    ];

    //    TODO: fix pricing (like the way it added to vehicle)
    protected $casts = [
        'billing_type' => BillingType::class,
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        // Set default currency_code if not provided
        static::creating(function (Addon $addon) {
            if (empty($addon->currency_code)) {
                $addon->currency_code = $addon->currencyService->defaultCurrency();
            }
        });
    }

    /**
     * Get the price as a Money object.
     */
    public function getPriceMoneyAttribute(): Money
    {
        return $this->currencyService->money(
            $this->price,
            $this->currency_code
        );
    }

    /**
     * Get the price as a decimal
     */
    public function getPriceDecimalAttribute(): float
    {
        return $this->currencyService->convertToDecimal(
            $this->price,
            $this->currency_code
        );
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->currencyService->format($this->price_money);
    }

    /**
     * Scope a query to only include active addons.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
