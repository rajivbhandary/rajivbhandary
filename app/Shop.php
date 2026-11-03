<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'property_id',
        'shop_no', 
        'facade_width',
        'facade_height',
        'additional_info'
    ];

    public function property() {
        return $this->hasOne(Property::class, 'id');
    }
}
