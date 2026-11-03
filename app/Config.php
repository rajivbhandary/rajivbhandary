<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'default_seo_author',
        'default_seo_description',
        'default_seo_keywords',
        'default_seo_og_title',
        'default_seo_og_description',
    ];
}
