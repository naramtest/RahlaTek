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

        $this->migrator->add('info.phones', [
            [
                'number' => '+971501234567',
                'label' => 'Main Office',
            ],
        ]);

        $this->migrator->add('info.emails', [
            [
                'email' => 'info@yourcompany.com',
                'label' => 'General Inquiries',
            ],
        ]);

        $this->migrator->add('info.socials', [
            [
                'platform' => 'facebook',
                'url' => 'https://facebook.com/yourcompany',
                'username' => '@yourcompany',
            ],
        ]);
    }
};
