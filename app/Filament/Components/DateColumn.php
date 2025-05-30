<?php

namespace App\Filament\Components;

use Filament\Tables\Columns\TextColumn;

class DateColumn
{
    public static function make($column)
    {
        return TextColumn::make($column)->dateTime('M j, Y')->sortable();
    }
}
