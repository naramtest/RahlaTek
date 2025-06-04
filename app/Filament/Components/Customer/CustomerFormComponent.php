<?php

namespace App\Filament\Components\Customer;

use App\Models\Customer;
use Filament\Forms;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CustomerFormComponent
{
    public static function clientInformationSchema(): array
    {
        return [
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Select::make('customer')
                        ->label(__('dashboard.Customer'))
                        ->relationship('customer', 'name')
                        ->preload()
                        ->searchable(['name', 'email', 'phone_number'])
                        ->getOptionLabelFromRecordUsing(
                            fn (
                                Customer $record
                            ) => "$record->name | $record->phone_number"
                        )
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->label(__('dashboard.name'))
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->label(__('dashboard.email'))
                                ->email()
                                ->maxLength(255),
                            PhoneInput::make('phone_number')
                                ->label(__('dashboard.phone_number'))
                                ->initialCountry('AE')
                                ->required(),
                            Forms\Components\Textarea::make('notes')
                                ->label(__('dashboard.notes'))
                                ->maxLength(1000),
                        ])
                        ->required()
                        ->helperText(__('dashboard.Select or Create Customer')),

                    // TODO: uncomment after adding Customer Resource

                    // Display the selected customers if in edit mode
                    //                    Forms\Components\Placeholder::make('customer_list')
                    //                        ->label(__('dashboard.selected_customers'))
                    //                        ->content(function (
                    //                            callable $get,
                    //                            callable $set,
                    //                            ?Model $record
                    //                        ) {
                    //                            if (! $record) {
                    //                                return '';
                    //                            }
                    //
                    //                            $customerList = '';
                    //                            // Generate URL to customer view page
                    //                            $url = CustomerResource::getUrl('view', [
                    //                                'record' => $record->getCustomer(),
                    //                            ]);
                    //
                    //                            // Create a clickable link to the customer view page
                    //                            $customerList .= sprintf(
                    //                                '• <a href="%s" target="_blank" class="text-primary-600 hover:underline">%s</a> (%s)<br>',
                    //                                $url,
                    //                                e($record->getCustomer()->name),
                    //                                e($record->getCustomer()->phone_number)
                    //                            );
                    //
                    //                            return new HtmlString($customerList);
                    //                        })
                    //                        ->visible(function (string $operation, $record): bool {
                    //                            return $operation !== 'create' and
                    //                                $record->getCustomer();
                    //                        }),
                ])
                ->columns(1)
                ->columnSpan(1),
        ];
    }
}
