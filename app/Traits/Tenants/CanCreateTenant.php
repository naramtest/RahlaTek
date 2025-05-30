<?php

namespace App\Traits\Tenants;

use App\Models\Tenant;
use App\Models\User;
use App\Settings\TenantSettings;
use Illuminate\Support\Facades\Artisan;

trait CanCreateTenant
{
    public function createTenantData(
        Tenant $tenant,
        User $user,
        bool $isVerify = true
    ): user {
        return $tenant->run(function () use ($user, $isVerify) {
            Artisan::call('app:tenant-permissions');
            $adminUser = new User;

            $adminUser->name = $user->name;
            $adminUser->email = $user->email;
            $adminUser->password = $user->password;
            if ($isVerify) {
                $adminUser->email_verified_at = now();
            }
            $adminUser->save();
            Artisan::call('tenants:run', [
                'commandname' => 'app:tenant-super',
                // String// Array
            ]);
            findOrCreateCustomerRole();

            return $adminUser;
        });
    }

    //    public function saveTenantInitTheme(Tenant $tenant, array $data)
    //    {
    //        return $tenant->run(function () use ($tenant, $data) {
    //            $settings = app(TenantSettings::class);
    //
    //            if (isset($data["theme_name"])) {
    //                $settings->theme_name = $data["theme_name"];
    //            }
    //            if ($data["theme_category"]) {
    //                $settings->theme_category = $data["theme_category"];
    //            }
    //
    //            $settings->save();
    //        });
    //    }
}
