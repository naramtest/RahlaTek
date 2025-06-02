<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\DriverResource\DriverFormSchema;
use App\Filament\Dashboard\Resources\DriverResource\DriverTableSchema;
use App\Filament\Dashboard\Resources\DriverResource\Pages;
use App\Models\Driver;
use Exception;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    protected static ?string $navigationIcon = 'gmdi-sports-motorsports-o';

    public static function form(Form $form): Form
    {
        return $form->columns(3)->schema(DriverFormSchema::schema());
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return DriverTableSchema::schema($table);
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
            'index' => Pages\ListDrivers::route('/'),
            'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.Drivers');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Driver');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.Drivers');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Business Management');
    }

    public static function getLabel(): ?string
    {
        return __('dashboard.Driver');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Drivers');
    }
}
