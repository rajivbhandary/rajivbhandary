<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyFacility extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'property_id',
        'additional_info'
    ];

    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
