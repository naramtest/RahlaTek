<?php

namespace App\Traits\Model;

trait HasReferenceNumber
{
    protected static function bootHasReferenceNumber(): void
    {
        static::creating(function ($model) {
            $prefix = $model->getReferenceNumberPrefix();
            $referenceColumn = $model->getReferenceNumberColumn();
            if (empty($model->{$referenceColumn})) {
                $model->{$referenceColumn} = $model->generateReferenceNumber(
                    $prefix
                );
            }
        });
    }

    protected function getReferenceNumberPrefix(): string
    {
        return 'SHP';
    }

    protected function getReferenceNumberColumn(): string
    {
        return 'reference_number';
    }

    // You can override these methods in your models if needed

    public function generateReferenceNumber(
        string $prefix = 'SHP',
        string $column = 'reference_number'
    ): string {
        $year = now()->format('Y');
        $month = now()->format('m');

        // Get model class
        $modelClass = get_class($this);

        // Use withTrashed() to include soft deleted records when checking for existing reference numbers
        $query = $modelClass::where($column, 'like', "$prefix-$year$month-%");

        // Check if the model uses soft deletes
        if (
            in_array(
                "Illuminate\Database\Eloquent\SoftDeletes",
                class_uses_recursive($modelClass)
            )
        ) {
            $query = $query->withTrashed();
        }

        $latestRecord = $query->orderBy('id', 'desc')->first();

        $sequence = 1;
        if ($latestRecord) {
            $parts = explode('-', $latestRecord->{$column});
            $sequence = intval(end($parts)) + 1;
        }

        return "$prefix-$year$month-".
            str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
}
