<?php

namespace App\Service;

use Illuminate\Support\Str;

class StrUtil
{
    private const CHAR_NOT_ACCEPTED = [" ", ".", "\\", "/", ":", "*", "?", "''", "<", ">", "|"];
    
    public static function converterCharNotAcceptedInUnderline(string $text): string
    {
        return Str::replace(self::CHAR_NOT_ACCEPTED, "_", $text);
    }

    public static function capitalLetter(string $text): string
    {
        return Str::upper($text);
    }

    public static function getMessageCharNotAccepted(): string
    {
        return "Os caracteres (" . implode(" ",Str::replace(" ","espaços",self::CHAR_NOT_ACCEPTED)) . "), serão alterados para _";
    }
}
