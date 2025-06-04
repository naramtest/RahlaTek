<?php

namespace App\Filament\Components\Customer;

use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class CustomerTableComponent
{
    public static function make()
    {
        return [
            //            TextColumn::make('customer.name')
            //                ->label(__('dashboard.client_name'))
            //                ->searchable()
            //                ->url(function ($record) {
            //                    return $record->getCustomer()
            //                        ? CustomerResource::getUrl('view', [
            //                            'record' => $record->getCustomer()->id,
            //                        ])
            //                        : null;
            //                })
            //                ->openUrlInNewTab()
            //                ->color('primary')
            //                ->sortable(),

            PhoneColumn::make('customer.phone_number')
                ->label(__('dashboard.client_phone'))
                ->searchable()
                ->url(
                    fn ($record) => $record->getCustomer()
                        ? 'tel:'.$record->getCustomer()->phone_number
                        : null
                )
                ->color('info')
                ->sortable(),
        ];
    }
}
