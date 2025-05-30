<?php

namespace App\Traits\Tenants;

trait CanRedirectTenant
{
    public static function redirectTenant($tenant): string
    {
        $redirectUrl = '/'.config('const.tenant_dashboard');

        $token = tenancy()->impersonate($tenant, 1, $redirectUrl);
        $url = url('/');
        $baseUrl = str_replace(['http://', 'https://'], '', $url);
        //        \Auth::logout();

        $protocol = app()->isProduction() ? 'https://' : 'http://';

        return $protocol.
            $tenant->domains->first()->domain.
            '.'.
            $baseUrl.
            '/impersonate/'.
            $token->token;
    }
}
