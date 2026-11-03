<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherCommercial extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'property_id',
        'office_no',
        'furnishing',
        'number_of_covered_parkings',
        'number_of_open_parkings',
        'additional_info'
    ]; //ground floor = 0

    public function property() {
        return $this->hasOne(Property::class);
    }
}
