<?php

namespace App\Listeners;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Stancl\Tenancy\Events\DeletingTenant;

class DeleteTenantStorage
{
    public function handle(DeletingTenant $event): void
    {
        File::deleteDirectory($event->tenant->run(fn () => storage_path()));
        Redis::connection()->del('r-k-tenants:'.$event->tenant->id);
        $event->tenant->run(function () {
            Redis::connection('settings')->del('.tenant');
        });
    }
}
