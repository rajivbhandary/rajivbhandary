<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FREAmenity extends Model
{
    use SoftDeletes;
    protected $table = "fre_amenities";
    protected $fillable = [
        'name',
        'f_r_e_id',
        'additional_info'
    ];

    public function fre(){
        return $this->belongsTo(FRE::class, 'id');
    }
}
