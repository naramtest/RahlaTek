<?php

namespace App\Enums\Reservation;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BillingType: string implements HasColor, HasLabel
{
    case Daily = 'daily';
    case Total = 'total';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Daily => __('dashboard.Daily'),
            self::Total => __('dashboard.Total'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Daily => 'warning',
            self::Total => 'success',
        };
    }
}
