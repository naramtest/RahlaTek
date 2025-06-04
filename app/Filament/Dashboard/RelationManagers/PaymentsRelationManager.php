<?php

namespace App\Filament\Dashboard\RelationManagers;

use App\Enums\Payments\PaymentMethod;
use App\Enums\Payments\PaymentStatus;
use App\Filament\Components\DateColumn;
use App\Models\Payment;
use App\Traits\HasPaymentActions;
use Exception;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;

class PaymentsRelationManager extends RelationManager
{
    use HasPaymentActions;

    protected static string $relationship = 'payments';

    protected static ?string $recordTitleAttribute = 'id';

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                MoneyColumn::make('amount')
                    ->label(__('dashboard.amount'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')->label(
                    __('dashboard.Method')
                ),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('dashboard.Status'))
                    ->badge(),
                DateColumn::make('created_at')->label(__('general.Created At')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(PaymentStatus::class)
                    ->label('Status'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('paymentOptions')
                    ->label(__('dashboard.Create Payment Link'))
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->form([
                        Toggle::make('sendLink')
                            ->label(
                                __('dashboard.Send Payment Link To Customer')
                            )
                            ->inline()
                            ->default(true),
                        MoneyInput::make('amount')
                            ->required()
                            ->label(__('dashboard.amount'))
                            ->default(function (RelationManager $livewire) {
                                $record = $livewire->getOwnerRecord();

                                return $record->total_price ?? 0;
                            })
                            ->helperText(function () {
                                return new HtmlString(
                                    '<span class="text-danger-600 dark:text-danger-400">'.
                                        __('dashboard.amount_payment_note').
                                        '</span>'
                                );
                            }),
                        Textarea::make('note')
                            ->label(__('dashboard.Payment Note'))
                            ->rows(2)
                            ->placeholder(
                                __(
                                    'dashboard.Enter a note about this payment (optional)'
                                )
                            )
                            ->maxLength(255),
                    ])
                    ->action(function (array $data, RelationManager $livewire) {
                        $record = $livewire->getOwnerRecord();
                        if ($data['sendLink']) {
                            $this->generateAndSend($record, $data);
                        } else {
                            $this->generate($record, $data);
                        }
                    })
                    ->modalWidth('lg'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->mutateFormDataUsing(
                    function (array $data, Payment $record): array {
                        if ($record->status === PaymentStatus::PAID) {
                            return $data;
                        }
                        if ($data['status'] === PaymentStatus::PAID->value) {
                            $data['paid_at'] = now()->toIso8601String();
                            $data['metadata'] = [
                                'manually_marked_as_paid' => true,
                            ];
                        }

                        return $data;
                    }
                ),
                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('download')
                    ->url(function (Payment $record) {
                        return route('admin.payment.invoice.download', [
                            'payment' => $record,
                        ]);
                    })
                    ->visible(
                        fn (Payment $record) => $record->isPaid() or
                            $record->isRefunded()
                    )
                    ->color('info')
                    ->icon('gmdi-download-o'),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('sendPaymentLink')
                        ->label('Send Link')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('primary')
                        ->action(function (Payment $record) {
                            $this->send($record);
                        }),

                    Action::make('copy')
                        ->icon('heroicon-s-clipboard-document-check')
                        ->action(function ($livewire, Payment $record) {
                            $url = route('payment.pay.show', [
                                'payment' => $record,
                            ]);

                            $livewire->js(
                                'window.navigator.clipboard.writeText("'.
                                    $url.
                                    '");
                    $tooltip("'.
                                    __('Copied to clipboard').
                                    '", { timeout: 1500 });'
                            );
                        }),
                    Tables\Actions\Action::make('markAsPaid')
                        ->label('Mark as Paid')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Payment $record) {
                            $record->updatePaymentToPaid([
                                'manually_marked_as_paid' => true,
                            ]);
                            Notification::make()
                                ->title('Payment marked as paid')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->visible(
                            fn (Payment $record) => $record->status ===
                                PaymentStatus::PENDING or
                                $record->status === PaymentStatus::PROCESSING
                        ),
                ])->visible(
                    fn (Payment $record) => ! $record->isPaid() and
                        ! $record->isRefunded()
                ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('status')
                ->label(__('dashboard.Payment Status'))
                ->options(PaymentStatus::class)
                ->required(),
            MoneyInput::make('amount')
                ->disabled(function ($operation) {
                    return $operation === 'edit';
                })
                ->label(__('dashboard.amount')),
            DateTimePicker::make('paid_at')->label(__('dashboard.Paid at')),
            Select::make('payment_method')
                ->options(PaymentMethod::class)
                ->label(__('dashboard.Payment Method')),
            TextInput::make('provider_id')
                ->label(__('dashboard.Payment ID / Reference'))
                ->columnSpanFull(),
            Textarea::make('note')
                ->label(__('dashboard.Note'))
                ->columnSpanFull(),
            KeyValue::make('metadata')
                ->label(__('dashboard.Payment Additional information'))
                ->columnSpanFull(),
        ]);
    }
}
