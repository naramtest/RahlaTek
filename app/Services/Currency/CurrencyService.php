<?php

namespace App\Services\Currency;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use NumberFormatter;

class CurrencyService
{
    /**
     * Convert Money object to a formatted string
     */
    public function format(Money $money, ?string $locale = null): string
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter(
                $locale ?? app()->getLocale(),
                NumberFormatter::CURRENCY
            ),
            new ISOCurrencies
        );

        return $formatter->format($money);
    }

    /**
     * Convert a decimal value to Money object
     */
    public function parse(
        float|string $amount,
        ?string $currencyCode = null
    ): Money {
        $currencies = new ISOCurrencies;
        $parser = new DecimalMoneyParser($currencies);

        return $parser->parse(
            (string) $amount,
            new Currency($currencyCode ?? $this->defaultCurrency())
        );
    }

    /**
     * Get the default currency code from config
     */
    public function defaultCurrency(): string
    {
        return config('app.money_currency', 'USD');
    }

    /**
     * Get decimal amount from integer value
     *
     * @param  int  $amount  The amount in minor units (cents)
     * @param  string|null  $currencyCode  The currency code
     */
    public function convertToDecimal(
        int $amount,
        ?string $currencyCode = null
    ): float {
        $money = $this->money($amount, $currencyCode);
        $currencies = new ISOCurrencies;
        $currency = $money->getCurrency();
        $subunit = $currencies->subunitFor($currency);

        return $amount / 10 ** $subunit;
    }

    /**
     * Get a Money object from integer amount
     */
    public function money(int $amount, ?string $currencyCode = null): Money
    {
        return new Money(
            $amount,
            new Currency($currencyCode ?? $this->defaultCurrency())
        );
    }
}
