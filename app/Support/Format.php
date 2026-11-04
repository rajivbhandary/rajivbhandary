<?php

namespace App\Support;

/**
 * Indian-style number and money formatting for listings.
 */
class Format
{
    /**
     * Short price: ₹85 L, ₹2.5 Cr, ₹45,000.
     */
    public static function inr($amount)
    {
        if ($amount === null || $amount === '' || !is_numeric($amount)) {
            return null;
        }
        $amount = (float) $amount;

        if ($amount >= 10000000) {
            return '₹' . self::trim($amount / 10000000) . ' Cr';
        }
        if ($amount >= 100000) {
            return '₹' . self::trim($amount / 100000) . ' L';
        }

        return '₹' . self::grouped($amount);
    }

    /**
     * Full amount with Indian digit grouping: 1,25,00,000.
     */
    public static function grouped($number)
    {
        $number = (string) (int) round((float) $number);
        $negative = $number[0] === '-';
        $number = ltrim($number, '-');
        if (strlen($number) > 3) {
            $last3 = substr($number, -3);
            $rest = substr($number, 0, -3);
            $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
            $number = $rest . ',' . $last3;
        }

        return ($negative ? '-' : '') . $number;
    }

    private static function trim($value)
    {
        return rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.');
    }
}
