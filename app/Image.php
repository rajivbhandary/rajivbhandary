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
        return $this->belongsTo(ImageProperty::class);
    }

    public function imageFRE(){
        return $this->belongsTo(ImageFRE::class);
    }
}
