<?php

namespace App\Http\Controllers;

use FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;
class ServeController extends Controller
{
    public function __construct()
    {
        FedaPay\FedaPay::setApiKey(config('fedapay.secret_key'));
        FedaPay\FedaPay::setEnvironment(config('fedapay.environment'));
    }

    public function index()
    {
        return view('welcome');
    }

    // public function create(Request $request)
    // {
        
    //         /* Remplacez VOTRE_CLE_API par votre véritable clé API */
    //     \FedaPay\FedaPay::setApiKey("pk_live_e9SGgW_Pt7jAdkI4w6DKRwce");

    //     /* Précisez si vous souhaitez exécuter votre requête en mode test ou live */
    //     \FedaPay\FedaPay::setEnvironment('live'); //ou setEnvironment('live');

    //     /* Créer la transaction */
    //     \FedaPay\Transaction::create(array(
    //         "description" => "Transaction for john.doe@example.com",
    //         "amount" => 2000,
    //         "currency" => ["iso" => "XOF"],
    //         "callback_url" => "https://pay.youpilab.com/",
    //         "customer" => [
    //             "firstname" => "John",
    //             "lastname" => "Doe",
    //             "email" => "frejus.toffi@youpilab.com",
    //             "phone_number" => [
    //                 "number" => "+22961041622",
    //                 "country" => "bj"
    //             ]
    //         ]
    //     ));

    // }



    public function fedapayTransaction(Request $request){

    //    dd($request->all());
        try {
            // dd(FedaPay\Transaction::all());

            $transaction = FedaPay\Transaction::create(
                $this->fedapayTransactionData()
            );
            $token = $transaction->generateToken();

            return redirect()->away($token->url);
        } catch(\Exception $e) {
            // dd(45);
            return back()->with('error', $e->getMessage());
        }
            //  dd($transaction);
            // exit();

    }

    private function fedapayTransactionData(){

        $customer_data = [
            'firstname' => 'Junior',
            'lastname' => 'Gantin',
            'email' => 'nioperas06@gmail.com',
            'phone_number' => [
                'number'  => '66526416',
                'country' => 'bj'
            ]
        ];


        return [
            'description' => 'Buy e-book!',
            'amount' => 5000000,
            'currency' => ['iso' => 'XOF'],
            'callback_url' => url('callback'),
            'customer' => $customer_data
        ];
    }


    public function callback()
    {    
        // echo 'allo';
        // exit();
        $transaction_id = $request->input('id');
        $message = '';
        // echo $message;
        // exit();

        try {
            $transaction = FedaPay\Transaction::retrieve($transaction_id);
            switch($transaction->status) {
                case 'approved':
                    $message = 'Transaction approuvée.';
                break;
                case 'canceled':
                    $message = 'Transaction annulée.';
                break;
                case 'declined':
                    $message = 'Transaction déclinée.';
                break;
            }

        } catch(\Exception $e) {
            $message = $e->getMessage();
        }

    }
}
