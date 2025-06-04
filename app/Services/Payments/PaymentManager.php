<?php

namespace App\Services\Payments;

use App\Enums\Payments\PaymentMethod;
use App\Services\Payments\Providers\Stripe\StripeElementsProvider;
use App\Services\Payments\Providers\Stripe\StripePaymentLinksProvider;

class PaymentManager
{
    public function driver(PaymentMethod $driver): PaymentService
    {
        $provider = match ($driver) {
            PaymentMethod::STRIPE_LINK => app(
                StripePaymentLinksProvider::class
            ),
            PaymentMethod::STRIPE_ELEMENTS => app(
                StripeElementsProvider::class
            ),
            PaymentMethod::Cash => throw new \Exception('To be implemented'),
        };

        return new PaymentService($provider);
    }
}
