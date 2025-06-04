<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class InfoSettings extends Settings
{
    use HasTranslations;

    public array $name = [];

    public array $address = [];

    public array $about = [];

    public array $slogan = [];

    public array $phones = [];

    public array $emails = [];

    public array $socials = [];

    // TODO:add those when the customer register

    //    public string $support_whatsapp_number = '';
    //
    //    public array $admin_phones = [];

    public static function group(): string
    {
        return 'info';
    }

    public function getTranslatableAttributes(): array
    {
        return ['name', 'address', 'about', 'slogan'];
    }

    // Helper methods for easier access
    public function getNameByLocale(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $this->name[$locale] ?? '';
    }

    public function getAddressByLocale(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $this->address[$locale] ?? '';
    }

    public function getAboutByLocale(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $this->about[$locale] ?? '';
    }

    public function getSloganByLocale(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $this->slogan[$locale] ?? '';
    }

    public function getFirstPhone(): ?string
    {
        return $this->phones[0]['number'] ?? null;
    }

    public function getFirstEmail(): ?string
    {
        return $this->emails[0]['email'] ?? null;
    }
}
