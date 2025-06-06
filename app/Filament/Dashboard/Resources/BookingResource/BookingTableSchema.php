<?php

namespace App\Filament\Dashboard\Resources\BookingResource;

use App\Enums\Reservation\ReservationStatus;
use App\Filament\Actions\Reservation\ReservationActions;
use App\Filament\Components\Customer\CustomerTableComponent;
use App\Filament\Components\DateColumn;
use App\Filament\Exports\BookingExporter;
use Exception;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;

class BookingTableSchema
{
    /**
     * @throws Exception
     */
    public static function schema(Table $table): Table
    {
        return $table
            ->dimCompleted([
                ReservationStatus::Completed,
                ReservationStatus::Cancelled,
            ])
            ->columns([
                Tables\Columns\TextColumn::make('reference_number')
                    ->label(__('dashboard.reference_number'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('vehicle.name')
                    ->label(__('dashboard.Vehicle'))
                    ->searchable()
                    ->sortable(),

                // todo:driver search need to be fixed
                Tables\Columns\TextColumn::make('driver.full_name')
                    ->label(__('dashboard.Driver'))
                    ->searchable(['drivers.first_name', 'drivers.last_name'])
                    ->sortable()
                    ->visible(fn () => notDriver())
                    ->toggleable(),
                ...CustomerTableComponent::make(),

                DateColumn::make('start_datetime')
                    ->label(__('dashboard.start_datetime'))
                    ->toggleable(),
                DateColumn::make('end_datetime')->label(
                    __('dashboard.end_datetime')
                ),
                Tables\Columns\TextColumn::make('pickup_address')
                    ->label(__('dashboard.pickup_address'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(30),

                MoneyColumn::make('total_price')
                    ->label(__('dashboard.Total Cost'))
                    ->sortable()
                    ->visible(fn () => notDriver())
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('dashboard.Status'))
                    ->badge()
                    ->sortable(),

                DateColumn::make('created_at')->label(__('general.Created_at')),
                DateColumn::make('updated_at')->label(
                    __('dashboard.updated_at')
                ),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                    ->label(__('dashboard.Status'))
                    ->options(fn (): string => ReservationStatus::class)
                    ->multiple(),
                DateRangeFilter::make('start_datetime')->label(
                    __('dashboard.start_datetime')
                ),
                DateRangeFilter::make('create_at')->label(
                    __('general.Created At')
                ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),

                ReservationActions::make()->visible(fn () => notDriver()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),

                Tables\Actions\ExportBulkAction::make()->exporter(
                    BookingExporter::class
                ),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
