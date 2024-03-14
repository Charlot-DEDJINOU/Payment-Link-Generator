<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;

class DisbursementRequestController extends Controller
{
    public static function AccessToken($auth, $Ocp)
    {
        $token = curl_init();
        curl_setopt($token, CURLOPT_URL, 'https://proxy.momoapi.mtn.com/disbursement/token/');
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
    
    public static function MoneyTransfer($access_token, $uuid, $Ocp, $amount, $phoneNum)
    {
        $transfer = curl_init();
        curl_setopt($transfer, CURLOPT_URL, 'https://proxy.momoapi.mtn.com/disbursement/v1_0/transfer');
        curl_setopt($transfer, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($transfer, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($transfer, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$access_token}",
            "X-Reference-Id: {$uuid}",
            "X-Target-Environment: mtnbenin",
            "Content-Type: application/json",
            "Cache-Control: no-cache",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
        ]);
        curl_setopt($transfer, CURLOPT_POSTFIELDS, "{\n    \"amount\": \"$amount\",\n    \"currency\": \"XOF\",\n    \"externalId\": \"string\",\n    \"payee\": {\n    \"partyIdType\": \"MSISDN\",\n    \"partyId\": \"$phoneNum\"\n    },\n    \"payerMessage\": \"string\",\n    \"payeeNote\": \"string\"\n}");
        curl_setopt($transfer, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($transfer, CURLOPT_SSL_VERIFYPEER, false); //ADD

        $response = curl_exec($transfer);
        $code = curl_getinfo($transfer, CURLINFO_HTTP_CODE);

        curl_close($transfer);
        error_log($code);
        var_dump(json_decode($response, true));

        return json_decode($response, true);
    }

    //TRANSFER STATUS
    //
    //
    public static function TransferStatus($uuid, $access_token, $Ocp)
    {
        $status = curl_init();
        curl_setopt($status, CURLOPT_URL, "https://proxy.momoapi.mtn.com/disbursement/v1_0/transfer/{$uuid}");
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

        error_log($code);
        var_dump(json_decode($response, true));
        return json_decode($response, true);
    }

    //REFUND
    //
    //
    public static function MoneyRefund($amount, $uuid, $access_token, $Ocp){
        $refund = curl_init();
        curl_setopt($refund, CURLOPT_URL, 'https://proxy.momoapi.mtn.com/disbursement/v1_0/refund');
        curl_setopt($refund, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($refund, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($refund, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$access_token}",
            "X-Reference-Id: {$uuid}",
            "X-Target-Environment: mtnbenin",
            "Content-Type: application/json",
            "Cache-Control: no-cache",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
        ]);
        curl_setopt($refund, CURLOPT_POSTFIELDS, "{\n    \"amount\": \"$amount\",\n    \"currency\": \"XOF\",\n    \"externalId\": \"string\",\n    \"payerMessage\": \"string\",\n    \"payeeNote\": \"string\",\n    \"referenceIdToRefund\": \"$uuid\"\n}");

        $response = curl_exec($refund);
        $code = curl_getinfo($refund, CURLINFO_HTTP_CODE);

        curl_close($refund);

        error_log($code);
        var_dump(json_decode($response, true));

        return json_decode($response, true);
    }

    public static function refundStatus($uuid, $access_token, $Ocp){
        $status = curl_init();
        curl_setopt($status, CURLOPT_URL, "https://proxy.momoapi.mtn.com/disbursement/v1_0/refund/{$uuid}");
        curl_setopt($status, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($status, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($status, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$access_token}",
            "X-Target-Environment: mtnbenin",
            "Cache-Control: no-cache",
            "Ocp-Apim-Subscription-Key: {$Ocp}",
        ]);
        
        $response = curl_exec($status);
        $code = curl_getinfo($status, CURLINFO_HTTP_CODE);

        curl_close($status);

        error_log($code);
        var_dump(json_decode($response, true));

        return json_decode($response, true);
    }
}