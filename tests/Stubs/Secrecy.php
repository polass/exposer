<?php

namespace Polass\Tests\Stubs;

class Secrecy
{
    public    $publicProperty    = 'public';
    protected $protectedProperty = 'protected';
    private   $privateProperty   = 'private';

    public function publicFunction($first, $second, $third = 'third') {
        return "called public function with `$first`, `$second`, `$third`";
    }

    protected function protectedFunction($first, $second, $third = 'third') {
        return "called protected function with `$first`, `$second`, `$third`";
    }

    private function privateFunction($first, $second, $third = 'third') {
        return "called private function with `$first`, `$second`, `$third`";
    }

    public static function publicStaticFunction($first, $second, $third = 'third') {
        return "called public static function with `$first`, `$second`, `$third`";
    }

    protected static function protectedStaticFunction($first, $second, $third = 'third') {
        return "called protected static function with `$first`, `$second`, `$third`";
    }

    private static function privateStaticFunction($first, $second, $third = 'third') {
        return "called private static function with `$first`, `$second`, `$third`";
    }
}
