<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentDetail extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'security_deposit_mode',
        'amount', 
        'duration_of_agreement',
        'months_of_notice',
        'additional_info'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function property() {
        return $this->hasOne(Property::class, 'rent_detail_id');
    }

}
