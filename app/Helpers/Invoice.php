<?php

namespace App\Helpers;

class Invoice
{
    public static function imageBaseUrl()
    {
        return env('API_URL') . '/client/images/invoices/';
    }

    public static function imageUrl($name)
    {
        return self::imageBaseUrl() . $name;
    }
}
