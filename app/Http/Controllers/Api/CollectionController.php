<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Component\Getuuid;
use App\Http\Controllers\Component\CollectionRequestController;
use App\Http\Controllers\Component\CollectionKeyController;
use Carbon\Carbon;

class CollectionController extends Controller
{

    public function rqsttopay(Request $request, $id_generate)
    {
        $phone = $request->input('phone') ;

        $uuid = Getuuid::UUIDs()[0];

        if(isset($phone)) {
           
            $transaction = Transaction::where('id_generate', $id_generate)->first();
            
            $amount = $transaction->amount ;

            $user = CollectionKeyController::ApiUser();
            $key = CollectionKeyController::ApiKey();
            $Ocp = CollectionKeyController::Ocp_Apim_Subscription_Key();
        
            $auth = CollectionKeyController::B64($user, $key);
        
            $token = CollectionRequestController::AccessToken($auth, $Ocp);
            extract($token);
        
            $pay = CollectionRequestController::RequestToPay($phone, $amount, $uuid, $access_token, $Ocp);
        
            $paymentStat = CollectionRequestController::PaymentStatus($uuid, $access_token, $Ocp);
            extract($paymentStat);
            
            $transaction->update([
                'numero' => $phone,
                'uuid' => $uuid,
                'id_payement' => $externalId,
                'status' => $status,
                'currency' => $currency,
            ]);

            if($transaction->status != $status && $status == 'SUCCESSFUL')
            {
                $transaction->update([
                    'payment_date' => Carbon::now()
                ]);
            }

            return $this->htmlPages($status, $transaction);
        }
    }

    public function paymentStatus($id_generate) 
    {

        $transaction = Transaction::where('id_generate', $id_generate)->first();

        $uuid =  $transaction->uuid;

        $user = CollectionKeyController::ApiUser();
        $key = CollectionKeyController::ApiKey();
        $Ocp = CollectionKeyController::Ocp_Apim_Subscription_Key();
    
        $auth = CollectionKeyController::B64($user, $key);
    
        $token = CollectionRequestController::AccessToken($auth, $Ocp);
        extract($token);

        $paymentStat = CollectionRequestController::PaymentStatus($uuid, $access_token, $Ocp);
        extract($paymentStat);

        $transaction->update([
            'status' => $status,
        ]);

        if($transaction->status != $status && $status == 'SUCCESSFUL')
        {
            $transaction->update([
                'payment_date' => Carbon::now()
            ]);
        }

        return $this->htmlPages($status, $transaction);
       
    }

    public function chkbalance() 
    {
        $user = CollectionKeyController::ApiUser();
        $key = CollectionKeyController::ApiKey();
        $Ocp = CollectionKeyController::Ocp_Apim_Subscription_Key();

        $auth = CollectionKeyController::B64($user, $key);

        $token = CollectionRequestController::AccessToken($auth, $Ocp);
        extract($token);

        $balance = CollectionRequestController::AccountBalance($access_token, $Ocp);
        extract($balance);

        echo "        
            <form method='POST'>
            <h4 class='h4 mb-3 fw-normal'>SOLDE</h4>
            <div class='paymentbox'>
                <div class='form-floating'>
                    <input type='text' class='form-control amount' id='floatingInput' name='amount' placeholder='Montant' value='$availableBalance $currency' readonly>
                    <label for='floatingInput'>Votre solde actuel est de</label>
                </div>
            </div>
            <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Charlot DEDJINOU | 2024</p>
            </form>";
    }

    protected function htmlPages($status, $transaction)
    {
        if ($status === "PENDING") {
            return response()->json([
                'status' => 'PENDING',
                'html' => view('requestToPayPend')->render()
            ]);
        } else if ($status === "SUCCESSFUL") {
            return response()->json([
                'status' => 'SUCCESSFUL',
                'html' => view('requestToPaySuccess',compact('transaction'))->render()
            ]);
        } else {
            return response()->json([
                'status' => 'FAILED',
                'html' => view('requestToPayFail',compact('transaction'))->render()
            ]);
        }
    }
}
