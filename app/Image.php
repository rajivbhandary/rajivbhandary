<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'path',
        'additional_info'
    ];

    public function imageProperty(){
        return $this->hasOne(ImageProperty::class, 'image_id');
    }

    public function imageFRE(){
        return $this->hasOne(ImageFRE::class, 'image_id');
    }
}
