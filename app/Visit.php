<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;

    protected $table = "shetabit_visits";
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * SCOPE QUERIES
     */
    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where(function ($q) use ($searchValue) {
            $q->where('created_at', 'like', "%{$searchValue}%")->orWhere('method', 'like', "%{$searchValue}%")->orWhere('url', 'like', "%{$searchValue}%")->orWhere('ip', 'like', "%{$searchValue}%")->orWhere('platform', 'like', "%{$searchValue}%")->orWhere('browser', 'like', "%{$searchValue}%")->orWhere('device', 'like', "%{$searchValue}%")->orWhere('languages', 'like', "%{$searchValue}%");
        });
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "created_at", "method", "url", "ip", "platform", "browser", "device", "languages"];
            return $query->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir']);
        }
        return $query;
    }

    public function scopeLimitBy($query, $start, $length)
    {
        if ($length != -1) {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }
}
