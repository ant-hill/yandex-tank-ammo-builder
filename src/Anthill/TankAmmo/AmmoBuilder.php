<?php

namespace Anthill\TankAmmo;

use GuzzleHttp\Psr7\Request;

class AmmoBuilder
{

    public function build(Request $request)
    {
        $requestString = \GuzzleHttp\Psr7\str($request) . "\r\n";
        $len = strlen($requestString);
        return "{$len}\r\n$requestString\r\n";
    }
}