<?php

namespace App\Filament\Shared\Pages;

use AbdulmajeedJamaan\FilamentTranslatableTabs\TranslatableTabs;
use App\Enums\SocialNetwork;
use App\Settings\InfoSettings;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Resources\Concerns\Translatable;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ManageInfoSettings extends SettingsPage
{
    //    use HasPageShield;
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = InfoSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.System Settings');
    }

    protected function getFormSchema(): array
    {
        return [
            Tabs::make(__('dashboard.info.title'))
                ->schema([
                    Tab::make('Info')
                        ->label(__('dashboard.info'))
                        ->icon('gmdi-info-o')
                        ->schema([
                            TranslatableTabs::make('anyLabel')
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->label(__('dashboard.name'))
                                        ->maxLength(50)
                                        ->columnSpan(1),
                                    TextInput::make('slogan')
                                        ->label(__('dashboard.Slogan'))
                                        ->columnSpan(1),
                                    Textarea::make('about')
                                        ->label(__('dashboard.About US'))
                                        ->maxLength(400)
                                        ->rows(3)
                                        ->columnSpan(1),
                                    Textarea::make('address')
                                        ->label(__('dashboard.address'))
                                        ->columnSpan(1)
                                        ->rows(3)
                                        ->maxLength(250),
                                ])
                                ->columnSpan(2)
                                ->columns(),
                        ])
                        ->columns(),
                    Tab::make('Contact')
                        ->label(__('dashboard.contacts'))
                        ->icon('gmdi-contacts-o')
                        ->schema([
                            Repeater::make('phones')
                                ->schema([
                                    TextInput::make('label')
                                        ->hiddenLabel()
                                        ->placeholder('Main Office'),
                                    PhoneInput::make('number')
                                        ->initialCountry('AE')
                                        ->label(__('dashboard.phone_number'))
                                        ->required()
                                        ->hiddenLabel(),
                                ])
                                ->columns()
                                ->columnSpan(1)
                                ->label(__('dashboard.phone_number')),

                            Repeater::make('emails')
                                ->schema([
                                    TextInput::make('label')
                                        ->hiddenLabel()
                                        ->placeholder(
                                            __('dashboard.General Inquiries')
                                        ),
                                    TextInput::make('email')
                                        ->email()
                                        ->label('Email')
                                        ->hiddenLabel()
                                        ->maxLength(100)
                                        ->prefixIcon('gmdi-email-o'),
                                ])
                                ->columns()
                                ->columnSpan(1)
                                ->label(__('dashboard.email')),
                        ])
                        ->columns(),

                    Tab::make('Social Media')
                        ->label(__('dashboard.social_title'))
                        ->icon('gmdi-tag-o')
                        ->schema([
                            Repeater::make('socials')
                                ->schema([
                                    Select::make('name')
                                        ->label(__('dashboard.Platform'))
                                        ->options(SocialNetwork::class)
                                        ->live(onBlur: true)
                                        ->hiddenLabel()
                                        ->selectablePlaceholder(false)
                                        ->prefixIcon('gmdi-share-o')
                                        ->columnSpan(1),
                                    TextInput::make('url')
                                        ->url()
                                        ->hiddenLabel()
                                        ->maxLength(100)
                                        ->prefixIcon('gmdi-link-o')
                                        ->columnSpan(2),
                                ])
                                ->columns(3)
                                ->defaultItems(1)
                                ->hiddenLabel()
                                ->label(trans('dashboard.social_title')),
                        ]),
                ])
                ->columnSpanFull(),
        ];
    }
}
