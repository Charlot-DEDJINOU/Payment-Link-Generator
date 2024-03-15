<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_lastname' => 'required|string',
            'customer_firstname' => 'required|string',
            'plateform' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'url_callback' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $transactionId = uniqid('txn_', true);

        $expirationTime = Carbon::now()->addMinutes(60 * 48);
        $link = route('transaction.confirm', ['id_generate' => $transactionId]);

        Transaction::create([
            'customer_lastname' => $request->input('customer_lastname'),
            'customer_firstname' => $request->input('customer_firstname'),
            'description' => $request->input('description'),
            'plateform' => $request->input('plateform'),
            'amount' => $request->input('amount'),
            'id_generate' => $transactionId,
            'expiration_time' => $expirationTime,
            'payment_link' => $link,
            'status' => 'pending',
            'currency' => 'XOF',
        ]);

        return response()->json(['confirmation_link' => $link], 200);
    }

    public function index($id_generate)
    {
        $transaction = Transaction::where('id_generate', $id_generate)->first();

        if ($transaction && $transaction->isValid()) {
            return view('transaction.index')->with('id_generate', $id_generate);
        } else {
            return view('transaction.expired', compact('transaction'));
        }
    }

    public function checkPayementMethod(Request $request, $id_generate)
    {
        $transaction = Transaction::where('id_generate', $id_generate)->first();

        if ($transaction && $transaction->isValid()) {

            $validator = Validator::make($request->all(), [
                'country' => 'required|string',
                'paymentMethod' => 'required|string|',
            ]);
    
            if ($validator->fails()) {
                return view('transaction.index')->with('error','Veuillez remplir tout les champs');
            }

            $transaction->update([
                'method' => $request->input('paymentMethod'),
                'country' => $request->input('country')
            ]);

            if($request->input('paymentMethod') == 'Mobile Money')
                return view('transaction.requestToPay',compact('transaction'));
            else
                return redirect()->away('https://vercel.com/dashboard');

        } else {
            return view('transaction.expired',compact('transaction'));
        }
    }

}
