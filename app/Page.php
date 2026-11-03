<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'route_name',
        'route_url',
        'additional_info',
        'seo_description',
        'seo_keywords',
        'seo_og_title',
        'seo_og_description',
    ];

    /**
     * SCOPE QUERIES
     */
    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('route_url', 'like', "%{$searchValue}%");
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "route_url", "seo_description", "seo_keywords", "seo_og_title", "seo_og_description"];
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
