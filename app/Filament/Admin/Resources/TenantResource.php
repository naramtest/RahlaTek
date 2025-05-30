<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TenantResource\Pages;
use App\Filament\Components\DateColumn;
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
            Section::make(__('admin.User Details'))
                ->relationship('user')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->label(__('general.Name')),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label(__('general.Email')),

                    TextInput::make('password')
                        ->label(__('general.Password'))
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
            Section::make('Clients Details')
                ->schema([
                    TextInput::make('id')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label(__('general.Name'))
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
                TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->label(__('general.Name')),
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('Username'),
                TextColumn::make('user.email')
                    ->sortable()
                    ->searchable()
                    ->label(__('general.Email')),
                DateColumn::make('created_at')->label(__('general.Created At')),
            ])
            ->filters([
                DateRangeFilter::make('created_at')->label(
                    __('general.Created At')
                ),
            ])
            ->actions([
                // TODO: add impersonate
                //                Action::make(__('dashboard.tenants.impersonate'))
                //                    ->icon('gmdi-support-agent-o')
                //                    ->color('info')
                //                    ->url(function (Tenant $record) {
                //                        return self::redirectTenant($record);
                //                    })
                //                    ->openUrlInNewTab(),
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
        return __('admin.Client');
    }

    public static function getModelLabel(): string
    {
        return __('admin.Client');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Clients');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin.Clients');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Clients');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Administration');
    }
}
