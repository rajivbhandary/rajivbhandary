<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageFRE extends Model
{
    protected $table = "fre_image";

    use SoftDeletes;
    protected $fillable = [
        'image_id',
        'f_r_e_id',
        'additional_info'
    ];
    
    public function fre(){
        return $this->belongsTo(FRE::class, 'id');
    }
   
    public function image(){
        return $this->belongsTo(Image::class);
    }
}
