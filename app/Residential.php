<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residential extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'property_id',
        'house_no', 
        'number_of_bedrooms',
        'number_of_separate_toilets',
        'furnishing',
        'number_of_covered_parkings',
        'number_of_open_parkings',
        'facing_direction',
        'additional_info'
    ]; //ground floor = 0

    public function property() {
        return $this->belongsTo(Property::class);
    }
}
