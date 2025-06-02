<?php

namespace App\Models\Abstract;

use App\Services\Currency\CurrencyService;
use Illuminate\Database\Eloquent\Model;

abstract class MoneyModel extends Model
{
    /**
     * The currency service
     */
    protected CurrencyService $currencyService;

    /**
     * Create a new Eloquent model instance.
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->currencyService = app(CurrencyService::class);
    }

    /**
     * Get the currency service.
     */
    //    protected function currencyService(): CurrencyService
    //    {
    //        return $this->currencyService;
    //    }
}
