<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FREOverviewKeypoint extends Model
{
    use SoftDeletes;
    protected $table = "overview_keypoints";
    protected $fillable = [
        'f_r_e_id',
        'name',
        'additional_info',
    ];

    public function fre(){
        return $this->belongsTo(FRE::class, 'f_r_e_id');
    }
}
