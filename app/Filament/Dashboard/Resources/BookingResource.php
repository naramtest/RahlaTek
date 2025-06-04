<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\BookingResource\BookingFormSchema;
use App\Filament\Dashboard\Resources\BookingResource\BookingTableSchema;
use App\Filament\Dashboard\Resources\BookingResource\Pages;
use App\Models\Booking;
use Auth;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'gmdi-event-o';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->columns(3)->schema(BookingFormSchema::schema());
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return BookingTableSchema::schema($table);
    }

    //    public static function getRelations(): array
    //    {
    //        return [PaymentsRelationManager::class];
    //    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
            'view' => Pages\ViewBooking::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);

        // If the authenticated user is a driver, only show their bookings
        if (Auth::user()->isDriver()) {
            $driver = Auth::user()->driver;
            if ($driver) {
                $query->where('driver_id', $driver->id);
            }
        }

        return $query;
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.Bookings');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Booking');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.Bookings');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Operations');
    }

    public static function getLabel(): ?string
    {
        return __('dashboard.Booking');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Bookings');
    }
}
