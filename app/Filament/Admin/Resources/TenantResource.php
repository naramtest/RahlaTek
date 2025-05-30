<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TenantResource\Pages;
use App\Models\Tenant;
use App\Models\User;
use App\Traits\Tenants\CanRedirectTenant;
use Exception;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class TenantResource extends Resource
{
    use CanRedirectTenant;

    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'gmdi-engineering-o';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('dashboard.user details'))
                ->relationship('user')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->label(__('dashboard.name')),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label(__('dashboard.Email')),

                    TextInput::make('password')
                        ->label(__('dashboard.password'))
                        ->password()
                        ->required(
                            fn (string $context): bool => $context === 'create'
                        )
                        ->maxLength(255)
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(static function ($state) use (
                            $form
                        ) {
                            if (! empty($state)) {
                                return Hash::make($state);
                            }

                            $user = User::find($form->getColumns());
                            if ($user) {
                                return $user->password;
                            }

                            return $state;
                        }),
                ])
                ->columnSpan(1),
            Section::make(__('dashboard.Tenant Details'))
                ->schema([
                    TextInput::make('id')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label(__('dashboard.name'))
                        ->disabled(
                            fn (string $context): bool => $context === 'edit'
                        ),
                    Repeater::make('domains')
                        ->relationship()
                        ->hiddenLabel()
                        ->schema([
                            TextInput::make('domain')
                                ->required()
                                ->prefix('https://')
                                ->suffix('.'.request()->getHost())
                                ->unique(ignoreRecord: true)
                                ->hiddenLabel(),
                        ])
                        ->columnSpan(1),
                ])
                ->columnSpan(1),
        ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label(__('dashboard.name')),
                TextColumn::make('user.email')
                    ->sortable()
                    ->searchable()
                    ->label(__('dashboard.Email')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y')
                    ->label(__('dashboard.Created At'))
                    ->sortable(),
            ])
            ->filters([DateRangeFilter::make('created_at')])
            ->actions([
                Action::make(__('dashboard.tenants.impersonate'))
                    ->icon('gmdi-support-agent-o')
                    ->color('info')
                    ->url(function (Tenant $record) {
                        return self::redirectTenant($record);
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('admin.Tenant');
    }

    public static function getModelLabel(): string
    {
        return __('admin.Tenant');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Tenants');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin.Tenants');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Tenants');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Administration');
    }
}
