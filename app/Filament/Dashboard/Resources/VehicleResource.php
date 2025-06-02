<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\VehicleResource\Pages;
use App\Filament\Dashboard\Resources\VehicleResource\VehicleFormSchema;
use App\Filament\Dashboard\Resources\VehicleResource\VehicleTableSchema;
use App\Models\Vehicle;
use Auth;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'gmdi-directions-car-o';

    public static function form(Form $form): Form
    {
        return $form->columns(3)->schema(VehicleFormSchema::schema());
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return VehicleTableSchema::schema($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
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
        return __('dashboard.Vehicles');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Vehicle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.Vehicles');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Business Management');
    }

    public static function getLabel(): ?string
    {
        return __('dashboard.Vehicle');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Vehicles');
    }
}
