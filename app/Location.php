<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'realtor', 
        'building_name',
        'street',
        'landmark',
        'locality',
        'town',
        'city',
        'pincode',
        'state',
        'country',
        'latitude',
        'longitude',
        'additional_info',
        'created_at'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function property() {
        return $this->hasOne(Property::class, 'location_id');
    }

    public function fre() {
        return $this->hasOne(FRE::class, 'location_id');
    }
}
