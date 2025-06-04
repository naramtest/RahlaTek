<?php

namespace App\Filament\Components\Customer;

use Filament\Actions\Exports\ExportColumn;
use Illuminate\Database\Eloquent\Model;

class CustomerExportComponent
{
    public static function get(): array
    {
        return [
            ExportColumn::make('client_name')
                ->label(__('dashboard.client_name'))
                ->formatStateUsing(
                    fn (Model $shipping) => $shipping->getCustomer()->name
                ),
            ExportColumn::make('client_email')
                ->label(__('dashboard.client_email'))
                ->formatStateUsing(
                    fn (Model $shipping) => $shipping->getCustomer()->email
                ),
            ExportColumn::make('client_phone')
                ->label(__('dashboard.client_phone'))
                ->formatStateUsing(
                    fn (Model $shipping) => $shipping->getCustomer()
                        ->phone_number
                ),
        ];
    }
}
