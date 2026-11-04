<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageProperty extends Model
{
    use SoftDeletes;
    protected $table = "image_property";
    protected $fillable = [
        'image_id',
        'property_id',
        'additional_info'
    ];

    public function property(){
        return $this->belongsTo(Property::class, 'property_id');
    }
   
    public function image(){
        return $this->belongsTo(Image::class);
    }
}
