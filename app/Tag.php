<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tag extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'additional_info'
    ];

    /**
     * MUTATORS
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    /**
     * RELATIONSHIP METHODS
     */
    public function blogs(){
        return $this->belongsToMany(Blog::class)->withTimestamps();
    }

    public function enquiries(){
        return $this->hasMany(Enquiry::class);
    }

    /**
     * SCOPE QUERIES
     */

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('name', 'like', "%{$searchValue}%");
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "name", "actions"];
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
