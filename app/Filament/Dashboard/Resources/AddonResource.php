<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\AddonResource\AddonFormSchema;
use App\Filament\Dashboard\Resources\AddonResource\AddonTableSchema;
use App\Filament\Dashboard\Resources\AddonResource\Pages;
use App\Models\Addon;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class AddonResource extends Resource
{
    use Translatable;

    protected static ?string $model = Addon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema(AddonFormSchema::schema());
    }

    public static function table(Table $table): Table
    {
        return AddonTableSchema::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAddons::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.Addons');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Addon');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.Addons');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Operations');
    }

    public static function getLabel(): ?string
    {
        return __('dashboard.Addon');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Addons');
    }

    public static function getNavigationParentItem(): ?string
    {
        return __('dashboard.Bookings');
    }
}
