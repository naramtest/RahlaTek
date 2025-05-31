<?php

namespace App\Enums\Payments;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasColor, HasLabel
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case PAID = 'paid';
    case FAILED = 'failed';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';

    public function getColor(): string|array|null
    {
        return match ($this) {
            PaymentStatus::PAID => 'success',
            PaymentStatus::PENDING => 'warning',
            PaymentStatus::PROCESSING => 'info',
            PaymentStatus::FAILED, PaymentStatus::CANCELED => 'danger',
            PaymentStatus::REFUNDED => 'gray',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            PaymentStatus::PAID => __('dashboard.Paid'),
            PaymentStatus::PENDING => __('dashboard.Pending'),
            PaymentStatus::PROCESSING => __('dashboard.Processing'),
            PaymentStatus::FAILED => __('dashboard.Failed'),
            PaymentStatus::CANCELED => __('dashboard.Canceled'),
            PaymentStatus::REFUNDED => __('dashboard.Refunded'),
        };
    }

    public function isFinal(): bool
    {
        // Check if the current status is in the provided statuses
        return in_array($this, [
            PaymentStatus::PAID,
            PaymentStatus::PROCESSING,
            PaymentStatus::REFUNDED,
        ]);
    }
}
