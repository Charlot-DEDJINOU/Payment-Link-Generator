<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
session_start();

class Getuuid extends Controller
{
    public static function UUIDs() {
        $uuid = Uuid::uuid4();
        
        do {
            $externalId = Uuid::uuid4();
        } while ($externalId->toString() === $uuid->toString());

        return [$uuid->toString(), $externalId->toString()];
    }
}