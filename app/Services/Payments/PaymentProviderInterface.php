<?php

namespace App\Services\Payments;

use App\Enums\Payments\PaymentMethod;
use App\Models\Payment;

interface PaymentProviderInterface
{
    public function getProviderName(): PaymentMethod;

    public function pay(Payment $payment): Payment;
}
