<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Land extends Model
{
    use SoftDeletes;

    protected $table = "land";

    protected $fillable = [
    'property_id',
    'additiona_info'
    ];

    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
