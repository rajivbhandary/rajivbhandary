<?php

namespace App\Support;

use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * Sanitises rich-text HTML (blog bodies, property descriptions,
 * testimonials) so stored content can't run scripts in visitors' or
 * admins' browsers.
 */
class Html
{
    private static $purifier;

    public static function clean($html)
    {
        if ($html === null || $html === '') {
            return '';
        }

        return self::purifier()->purify((string) $html);
    }

    /**
     * Plain-text version for excerpts and meta tags.
     */
    public static function text($html)
    {
        $text = html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/\s+/u', ' ', $text));
    }

    private static function purifier()
    {
        if (self::$purifier === null) {
            $config = HTMLPurifier_Config::createDefault();
            $cacheDir = storage_path('framework/cache/htmlpurifier');
            if (!is_dir($cacheDir)) {
                @mkdir($cacheDir, 0755, true);
            }
            $config->set('Cache.SerializerPath', $cacheDir);
            $config->set('HTML.Allowed', implode(',', [
                'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'blockquote',
                'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol', 'li', 'hr', 'span',
                'a[href|title|target|rel]', 'img[src|alt|width|height]',
                'table', 'thead', 'tbody', 'tr', 'th', 'td',
            ]));
            $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => true, 'tel' => true]);
            $config->set('Attr.AllowedFrameTargets', ['_blank']);
            $config->set('HTML.TargetNoopener', true);
            $config->set('HTML.TargetNoreferrer', true);
            $config->set('AutoFormat.RemoveEmpty', true);

            self::$purifier = new HTMLPurifier($config);
        }

        return self::$purifier;
    }
}
