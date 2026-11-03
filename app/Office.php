<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'property_id',
        'office_no', 
        'number_of_seats',
        'number_of_cabins',
        'number_of_meeting_rooms',
        'reception_area',
        'pantry',
        'staircase',
        'lift',
        'additional_info'
    ];

    public function property() {
        return $this->belongsTo(Property::class);
    }
}
