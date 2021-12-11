<?php

namespace App\Sanitizers;

use function preg_replace;

class DigitsOnlySanitizer
{
    public static function sanitize(string $value) : string
    {
        $phone = preg_replace('/\D+/', '', $value);
        if ($phone[0] === '8') {
            $phone[0] = '7';
        }
        return $phone;
    }
}
