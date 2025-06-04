<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('info.name', [
            'en' => 'Your Company Name',
            'ar' => 'اسم شركتك',
        ]);

        $this->migrator->add('info.address', [
            'en' => 'Your Company Address',
            'ar' => 'عنوان شركتك',
        ]);

        $this->migrator->add('info.about', [
            'en' => 'About your company',
            'ar' => 'حول شركتك',
        ]);

        $this->migrator->add('info.slogan', [
            'en' => 'Your company slogan',
            'ar' => 'شعار شركتك',
        ]);

        $this->migrator->add('info.phones', []);

        $this->migrator->add('info.emails', []);

        $this->migrator->add('info.socials', []);
    }
};
