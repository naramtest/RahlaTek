<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Services\Tenants\CreateTenantService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Tenant $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(CreateTenantService $createTenantService): void
    {
        $createTenantService->createTenantData(
            $this->tenant,
            $this->tenant->user
        );
    }
}
