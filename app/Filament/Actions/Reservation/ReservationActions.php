<?php

namespace App\Filament\Actions\Reservation;

use App\Enums\Reservation\ReservationStatus;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Model;

class ReservationActions
{
    public static function make()
    {
        return ActionGroup::make([
            Action::make('confirm')
                ->label(__('dashboard.Confirm'))
                ->icon('heroicon-o-check')
                ->color('primary')
                ->action(function (Model $record) {
                    $record->update([
                        'status' => ReservationStatus::Confirmed->value,
                    ]);
                })
                ->requiresConfirmation()
                ->visible(
                    fn (Model $record) => $record->status ==
                        ReservationStatus::Cancelled ||
                        $record->status == ReservationStatus::Pending
                ),

            Action::make('cancel')
                ->label(__('dashboard.Cancel'))
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->action(function (Model $record) {
                    $record->update([
                        'status' => ReservationStatus::Cancelled->value,
                    ]);
                })
                ->requiresConfirmation()
                ->visible(
                    fn (Model $record) => $record->status !=
                        ReservationStatus::Completed &&
                        $record->status != ReservationStatus::Cancelled
                ),
            Action::make('complete')
                ->label(__('dashboard.mark_as_completed'))
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function (Model $record) {
                    $record->update([
                        'status' => ReservationStatus::Completed,
                    ]);
                })
                ->requiresConfirmation()
                ->visible(
                    fn (Model $record) => $record->status ==
                        ReservationStatus::Active or
                        $record->status == ReservationStatus::Confirmed
                ),

            Action::make('activate')
                ->label(__('dashboard.mark_as_active'))
                ->icon('heroicon-o-play')
                ->color('warning')
                ->action(function (Model $record) {
                    $record->update([
                        'status' => ReservationStatus::Active,
                    ]);
                })
                ->requiresConfirmation()
                ->visible(
                    fn (Model $record) => $record->status ==
                        ReservationStatus::Confirmed ||
                        $record->status == ReservationStatus::Pending
                ),
        ]);
    }
}
