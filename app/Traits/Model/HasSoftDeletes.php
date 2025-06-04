<?php

namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasSoftDeletes
{
    use Prunable;
    use SoftDeletes;

    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }
}
