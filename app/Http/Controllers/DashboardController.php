<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Controllers\Api\CollectionController;

class DashboardController extends Controller
{
   public function index()
   {
      $transactions = Transaction::all();

      return view('dashboard.index', compact('transactions'));
   }

   public function getCreateTransaction()
   {
      return view('dashboard.createTransaction');
   }

   public function transaction($id_generate)
   {
      $transaction = Transaction::where('id_generate', $id_generate);

      return view('dashboard.transaction', compact('transaction'));
   }

   public function refreshTransiction($id_generate)
   {
      $collectionController = new CollectionController();

      $response = $collectionController->paymentStatus($id_generate);
   }
}
