<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;

class DisbursementKeyController extends Controller
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
        $primary = "67a613e0b15242619ec7c4f93cbef11a";
        $secondary = "e98bc398f247450b9df109d3f796b1a1";
    
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
