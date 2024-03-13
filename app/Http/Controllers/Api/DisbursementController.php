<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Component\Getuuid;
use App\Http\Controllers\Component\DisbursementRequestController;
use App\Http\Controllers\Component\DisbursementKeyController;
use Illuminate\Http\Request;

class DisbursementController extends Controller
{
    public function refund(Request $request) 
    {
        $phone = $request->input('phone');
        $amount = $request->input('amount');
        $uuids = Getuuid::UUIDs();

        if (isset($phone)) {
           
            $_SESSION['phone'] = $phone;
            $amount = $_POST['amount'];
        
            $_SESSION['uuid'] = $uuids[0];
            $uuid = $_SESSION['uuid'];
        
            $user = DisbursementKeyController::ApiUser();
            $key = DisbursementKeyController::ApiKey();
            $Ocp = DisbursementKeyController::Ocp_Apim_Subscription_Key();
        
            $auth = DisbursementKeyController::B64($user, $key);
        
            $token = DisbursementRequestController::AccessToken($auth, $Ocp);
            extract($token);
        
            $refund = DisbursementRequestController::MoneyRefund($amount, $uuid, $access_token, $Ocp);
        
            $refundStat = DisbursementRequestController::refundStatus($uuid, $access_token, $Ocp);
            extract($refundStat);
        
            $success_redirect_link = "https://youpilab.com/components/";
            $fail_redirect_link = "https://youpilab.com/components/account/checkout";
        
        
            if ($status === "PENDING") {
                echo "        
                <form method='POST'>
                <img src='img/yl_loader.gif' alt=''>
                <h2 class='h2 mb-3 fw-normal'>Veuillez bien vouloir valider la transaction sur votre téléphone portable.</h2>
        
                <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Mohamed ASSAL | 2023</p>
            </form>";
            } else if ($status === "SUCCESSFUL") {
                echo "        
            <form method='POST'>
                <h4 class='h4 mb-3 fw-normal'>Transfer effectué avec succès</h4>
                <img class='mb-4 img-fluid w-25' src='img/yl_success.png' alt='' width='72' height='57'>
                <div class='paymentbox'>
                    <div class='form-floating'>
                        <input type='text' class='form-control amount' id='floatingInput' name='amount' placeholder='Montant' value='$amount $currency' readonly>
                        <label for='floatingInput'>Vous avez réalisé un paiement d'un montant de</label>
                    </div>
                    <div class='form-floating'>
                        <input type='tel' class='form-control' id='phone' name='phone' pattern='[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}' value='$phone' readonly>
                        <label for='floatingPassword'>Le paiement a été réalisé en utilisant le numéro de téléphone</label>
                    </div>
                    <div class='form-floating'>
                        <input type='text' class='form-control' id='floatingInput' name='status' placeholder='Statut' value='$status' readonly>
                        <label for='floatingInput'>État de la transaction financière</label>
                    </div>
                    <div class='form-floating'>
                        <input type='text' class='form-control payid' id='floatingInput' name='externalId' placeholder='Statut' value='$externalId' readonly>
                        <label for='floatingInput'>Id du paiement</label>
                    </div>
                </div>
                <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Mohamed ASSAL | 2023</p>
            </form>
            <script>setTimeout(function() {window.location.href = '$success_redirect_link';}, 3000);</script>";
            } else {
                echo "    
                <form method='POST'>
                    <img class='mb-4 img-fluid w-25' src='img/yl_fail.png' alt='' width='72' height='57'>
                    <h4 class='h4 mb-3 fw-normal'>Un problème est survenue lors du transfert<br>Veuillez réssayez</h4>
                    <p>NB: Vérifier que vous avez entrer un numéro Mobile Money Valide</p>
                    <div class='paymentbox'>
                        <div class='form-floating'>
                            <input type='number' class='form-control' id='floatingInput' name='amount' placeholder='Montant' value='100' readonly>
                            <label for='floatingInput'>Montant</label>
                        </div>
                        <div class='form-floating'>
                            <input type='tel' class='form-control' id='phone' name='phone' pattern='[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}' value='$phone' readonly>
                            <label for='floatingPassword'>Numéro de téléphone</label>
                        </div>
                    </div>
                    <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Mohamed ASSAL | 2023</p>
                </form>
                <script>setTimeout(function() {window.location.href = '$fail_redirect_link';}, 5000);</script>";
            }
        }
    }

    public function transfer(Request $request) 
    {
        $phone = $request->input('phone');
        $amount = $request->input('amount');
        $uuids = Getuuid::UUIDs();

        if (isset($phone)) {
           
            $_SESSION['phone'] = $phone;
            $amount = $_POST['amount'];
        
            $_SESSION['uuid'] = $uuids[0];
            $uuid = $_SESSION['uuid'];
        
            $user = DisbursementKeyController::ApiUser();
            $key = DisbursementKeyController::ApiKey();
            $Ocp = DisbursementKeyController::Ocp_Apim_Subscription_Key();
        
            $auth = DisbursementKeyController::B64($user, $key);
        
            $token = DisbursementRequestController::AccessToken($auth, $Ocp);
            extract($token);
        
            $transfer = DisbursementRequestController::MoneyTransfer($access_token, $uuid, $Ocp, $amount, $phone);
        
            $transferStat = DisbursementRequestController::TransferStatus($uuid, $access_token, $Ocp);
            extract($transferStat);
        
            $success_redirect_link = "https://youpilab.com/components/";
            $fail_redirect_link = "https://youpilab.com/components/account/checkout";
        
        
            if ($status === "PENDING") {
                echo "        
                <form method='POST'>
                <img src='img/yl_loader.gif' alt=''>
                <h2 class='h2 mb-3 fw-normal'>Veuillez bien vouloir valider la transaction sur votre téléphone portable.</h2>
        
                <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Mohamed ASSAL | 2023</p>
            </form>";
            } else if ($status === "SUCCESSFUL") {
                echo "        
            <form method='POST'>
                <h4 class='h4 mb-3 fw-normal'>Transfer effectué avec succès</h4>
                <img class='mb-4 img-fluid w-25' src='img/yl_success.png' alt='' width='72' height='57'>
                <div class='paymentbox'>
                    <div class='form-floating'>
                        <input type='text' class='form-control amount' id='floatingInput' name='amount' placeholder='Montant' value='$amount $currency' readonly>
                        <label for='floatingInput'>Vous avez réalisé un paiement d'un montant de</label>
                    </div>
                    <div class='form-floating'>
                        <input type='tel' class='form-control' id='phone' name='phone' pattern='[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}' value='$phone' readonly>
                        <label for='floatingPassword'>Le paiement a été réalisé en utilisant le numéro de téléphone</label>
                    </div>
                    <div class='form-floating'>
                        <input type='text' class='form-control' id='floatingInput' name='status' placeholder='Statut' value='$status' readonly>
                        <label for='floatingInput'>État de la transaction financière</label>
                    </div>
                    <div class='form-floating'>
                        <input type='text' class='form-control payid' id='floatingInput' name='externalId' placeholder='Statut' value='$externalId' readonly>
                        <label for='floatingInput'>Id du paiement</label>
                    </div>
                </div>
                <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Mohamed ASSAL | 2023</p>
            </form>
            <!-- <script>setTimeout(function() {window.location.href = '$success_redirect_link';}, 3000);</script> -->";
            } else {
                echo "    
                <form method='POST'>
                    <img class='mb-4 img-fluid w-25' src='img/yl_fail.png' alt='' width='72' height='57'>
                    <h4 class='h4 mb-3 fw-normal'>Un problème est survenue lors du transfert<br>Veuillez réssayez</h4>
                    <p>NB: Vérifier que vous avez entrer un numéro Mobile Money Valide</p>
                    <div class='paymentbox'>
                        <div class='form-floating'>
                            <input type='number' class='form-control' id='floatingInput' name='amount' placeholder='Montant' value='100' readonly>
                            <label for='floatingInput'>Montant</label>
                        </div>
                        <div class='form-floating'>
                            <input type='tel' class='form-control' id='phone' name='phone' pattern='[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}' value='$phone' readonly>
                            <label for='floatingPassword'>Numéro de téléphone</label>
                        </div>
                    </div>
                    <p class='mt-5 mb-3 text-muted'>&copy; Copyright by Mohamed ASSAL | 2023</p>
                </form>
               <!-- <script>setTimeout(function() {window.location.href = '$fail_redirect_link';}, 5000);</script> -->";
            }
        }
    }
}
