<?php

namespace App\Models;

use App\Traits\Model\HasSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Customer extends Model
{
    use HasSoftDeletes;

    protected $fillable = ['name', 'email', 'phone_number'];

    public function bookings(): MorphToMany
    {
        return $this->morphedByMany(
            Booking::class,
            'customerable'
        )->withTimestamps();
    }

    //    public function rents(): MorphToMany
    //    {
    //        return $this->morphedByMany(
    //            Rent::class,
    //            "customerable"
    //        )->withTimestamps();
    //    }
    //
    //    public function shippings(): MorphToMany
    //    {
    //        return $this->morphedByMany(
    //            Shipping::class,
    //            "customerable"
    //        )->withTimestamps();
    //    }
}
