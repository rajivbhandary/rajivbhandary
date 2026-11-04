<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    private const CACHE_KEY = 'site-config';

    protected $fillable = [
        'default_seo_author',
        'default_seo_description',
        'default_seo_keywords',
        'default_seo_og_title',
        'default_seo_og_description',
        'contact_phone',
        'contact_whatsapp',
        'contact_email',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

    /**
     * Site-wide settings, cached so public pages don't query them on
     * every request. Returns an empty instance on a fresh install.
     */
    public static function current()
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::first() ?? new static();
        });
    }

    /** Phone number formatted for display, e.g. +91 98200 12345. */
    public function getPhoneDisplayAttribute()
    {
        return self::formatIndianNumber($this->contact_phone);
    }

    /** tel: link target, e.g. +919820012345. */
    public function getPhoneHrefAttribute()
    {
        $digits = self::digits($this->contact_phone);

        return $digits ? '+' . $digits : null;
    }

    /** wa.me link for the WhatsApp number (falls back to the phone number). */
    public function whatsappUrl($message = null)
    {
        $digits = self::digits($this->contact_whatsapp ?: $this->contact_phone);
        if (!$digits) {
            return null;
        }

        return 'https://wa.me/' . $digits . ($message ? '?text=' . rawurlencode($message) : '');
    }

    private static function digits($number)
    {
        $digits = preg_replace('/\D+/', '', (string) $number);
        if (strlen($digits) === 10) {
            $digits = '91' . $digits;
        }

        return strlen($digits) >= 11 ? $digits : null;
    }

    private static function formatIndianNumber($number)
    {
        $digits = self::digits($number);
        if (!$digits) {
            return null;
        }
        if (strlen($digits) === 12 && substr($digits, 0, 2) === '91') {
            return '+91 ' . substr($digits, 2, 5) . ' ' . substr($digits, 7);
        }

        return '+' . $digits;
    }
}
