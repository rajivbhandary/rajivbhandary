<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'developer_rera_number',
        'info',
        'additional_info',
    ];

    public function fre() {
        return $this->belongsTo(FRE::class, 'id');
    }
}
