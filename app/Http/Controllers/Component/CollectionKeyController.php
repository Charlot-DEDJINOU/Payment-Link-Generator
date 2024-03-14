<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;

class CollectionKeyController extends Controller
{

    public static function ApiUser(){
        $apiUser = "466d1b57-bfef-47d6-897c-d9a36b49ab5e";
    
        return $apiUser;
    }
    
    public static function ApiKey(){
        $apiKey = "bf21f9cebe2c477db2322c1fe67f46fb";
    
        return $apiKey;
    }
    
    public static function Ocp_Apim_Subscription_Key(){
        $primary = "edb2ad8c18e24bf69db48dc391e30b2d";
        $secondary = "6d9c7eadccb448a897f48044e51dfe94";
    
        $keys = array($primary,$secondary);
        $i = rand(0, count($keys)-1);
        return $keys[$i];
    }
    
    public static function B64($apiUser, $apiKey)
    {
        $auth = $apiUser . ':' . $apiKey;
    
        $auth = base64_encode($auth);
    
        return $auth;
    }
}

