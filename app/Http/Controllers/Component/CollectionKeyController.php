<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;

class CollectionKeyController extends Controller
{

    public static function ApiUser(){
        $apiUser = "YOUR API USER";
    
        return $apiUser;
    }
    
    public static function ApiKey(){
        $apiKey = "YOUR API KEY";
    
        return $apiKey;
    }
    
    public static function Ocp_Apim_Subscription_Key(){
        $primary = "YOUR PRIMARY";
        $secondary = "YOUR SECONDARY";
    
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