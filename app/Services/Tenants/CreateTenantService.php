<?php

namespace App\Services\Tenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class CreateTenantService
{
    public function createTenantData(
        Tenant $tenant,
        User $user,
        bool $isVerify = true
    ): user {
        logger('naram');
        $this->findOrCreateCustomerRole();
        $user->assignRole(config('const.client_role'));

        return $tenant->run(function () use ($user, $isVerify) {
            logger('naram');
            Artisan::call('app:tenant-permissions');
            $adminUser = new User;

            $adminUser->name = $user->name;
            $adminUser->email = $user->email;
            $adminUser->password = $user->password;
            if ($isVerify) {
                $adminUser->email_verified_at = now();
            }
            $result = $adminUser->save();
            logger('naram');
            Artisan::call('tenants:run', [
                'commandname' => 'app:tenant-super',
                // String// Array
            ]);
            $this->findOrCreateCustomerRole();

            return $adminUser;
        });
    }

    public function findOrCreateCustomerRole(): void
    {
        if (! Role::where('name', config('const.client_role'))->exists()) {
            Role::create(['name' => config('const.client_role')]);
        }
    }
}
