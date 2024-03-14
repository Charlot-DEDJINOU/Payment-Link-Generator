<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;

class CollectionRequestController extends Controller
{

   public static function AccessToken($auth, $Ocp)
    {
        $token = curl_init();
        curl_setopt($token, CURLOPT_URL, 'https://proxy.momoapi.mtn.com/collection/token/');
        curl_setopt($token, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($token, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($token, CURLOPT_HTTPHEADER, [
            "Authorization: Basic {$auth}",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
            "Content-Type: application/x-www-form-urlencoded",
        ]);
        curl_setopt($token, CURLOPT_POSTFIELDS, '');
        curl_setopt($token, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($token, CURLOPT_SSL_VERIFYPEER, false); //ADD


        $response = curl_exec($token);
        $code = curl_getinfo($token, CURLINFO_HTTP_CODE);

        curl_close($token);

        return json_decode($response, true);
    }

    //REQUEST TO PAY
    //
    //
    public static function RequestToPay($phoneNum, $amount, $uuid, $access_token, $Ocp)
    {
        $pay = curl_init();
        curl_setopt($pay, CURLOPT_URL, 'https://proxy.momoapi.mtn.com/collection/v1_0/requesttopay');
        curl_setopt($pay, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($pay, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($pay, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$access_token}",
            "X-Reference-Id: {$uuid}",
            "X-Target-Environment: mtnbenin",
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
        ]);
        curl_setopt($pay, CURLOPT_POSTFIELDS, "{\n    \"amount\": \"$amount\",\n    \"currency\": \"XOF\",\n    \"externalId\": \"$uuid\",\n    \"payer\": {\n      \"partyIdType\": \"MSISDN\",\n      \"partyId\": \"$phoneNum\"\n    },\n    \"payerMessage\": \"Transaction éffectué\",\n    \"payeeNote\": \"Auth\"\n  }");
        curl_setopt($pay, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($pay, CURLOPT_SSL_VERIFYPEER, false); //ADD


        $response = curl_exec($pay);
        $code = curl_getinfo($pay, CURLINFO_HTTP_CODE);

        curl_close($pay);
       
        return json_decode($response, true);
    }

    // PAYMENT STATUS
    //
    //
    public static function PaymentStatus($uuid, $access_token, $Ocp)
    {
        $status = curl_init();
        curl_setopt($status, CURLOPT_URL, "https://proxy.momoapi.mtn.com/collection/v1_0/requesttopay/{$uuid}");
        curl_setopt($status, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($status, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($status, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$access_token}",
            "X-Target-Environment: mtnbenin",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
        ]);
        curl_setopt($status, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($status, CURLOPT_SSL_VERIFYPEER, false); //ADD


        $response = curl_exec($status);

        $code = curl_getinfo($status, CURLINFO_HTTP_CODE);

        curl_close($status);
        
        return json_decode($response, true);
    }

    // ACCOUNT BALANCE
    //
    //
    public static function AccountBalance($access_token, $Ocp)
    {
        $balance = curl_init();
        curl_setopt($balance, CURLOPT_URL, "https://proxy.momoapi.mtn.com/collection/v1_0/account/balance");
        curl_setopt($balance, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($balance, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($balance, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$access_token}",
            "X-Target-Environment: mtnbenin",
            "Cache-Control: no-cache",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
        ]);
        curl_setopt($balance, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($balance, CURLOPT_SSL_VERIFYPEER, false); //ADD


        $response = curl_exec($balance);

        curl_close($balance);
        $code = curl_getinfo($balance, CURLINFO_HTTP_CODE);

        curl_close($balance);
        
        return json_decode($response, true);
    }
}