<?php

namespace App\Http\Controllers\Api;

use FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    public function __construct()
    {
        FedaPay\FedaPay::setApiKey(config('fedapay.secret_key'));
        FedaPay\FedaPay::setEnvironment(config('fedapay.environment'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'ok';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function init_transaction($data)
    {
        $data = json_decode($data, true);

        // $data = [
        //     "firstname"=>"fadel",
        //     "lastname"=>"fadel",
        //     "email"=>"fadel@gmail.com",
        //     "number"=>"61250000",
        //     "countryCode"=>"bj",
        //     "description"=>"desc",
        //     "amount"=>"1000",
        //     "callback_url"=>"https://youpilab.com",
        // ];
        

        try {
            $transaction = FedaPay\Transaction::create(
                $this->fedapayTransactionData($data)
            );
            $token = $transaction->generateToken();
            return redirect()->away($token->url);
        } catch(\Exception $e) {
			\Illuminate\Support\Facades\Log::info($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    private function fedapayTransactionData($data){
	
        $customer_data = [
            'firstname' =>$data['firstname'],
            'lastname' =>$data['lastname'],
            'email' =>$data['email'],
           // 'callback' =>$callback_url,
            'phone_number' => [
                'number'  => $data['number'],
                'country' => $data['countryCode']
            ]
        ];

        if($data['callback_url'] == "education"){
            $callback_url = env('EDUCATION_PAYMENT_CALLBACK_URL').$data['description'];
        }elseif($data['callback_url'] == "components"){
			$callback_url = env('COMPONENTS_PAYMENT_CALLBACK_URL').$data['description'];
		}elseif($data['callback_url'] == "FCHANGES"){
			$callback_url = env('COINCHANGE_PAYMENT_CALLBACK_URL').$data['description'];
		}elseif($data['callback_url'] == "dakodo"){
			$callback_url = env('DAKODO_PAYMENT_CALLBACK_URL').$data['description'];
		}elseif($data['callback_url'] == "iot"){
			$callback_url = env('IOT_PAYMENT_CALLBACK_URL').$data['description'];
		}
		elseif($data['callback_url'] == "convention"){
			$callback_url = env('CONVENTION_CALLBACK_URL');
		}

        return [
            'description' => $data['description'],
            'amount' => $data['amount'],
            'currency' => ['iso' => 'XOF'],
            'callback_url' => $callback_url,
            'customer' => $customer_data
        ];
    }

    public function callback()
    {  
        $transaction_id = $request->input('id');
        $message = '';

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
