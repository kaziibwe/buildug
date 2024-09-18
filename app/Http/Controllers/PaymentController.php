<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //



    public function deposit(Request $request)
    {
        try{
        $form =$request->validate([

            'amount'=> 'required | string',
            'id' => 'required|exists:users,id',
           ]);
           $accountBalance = User::where('id', $form['id'])->value('account_balance');

           $string = $accountBalance;

           $integer = (int) $string;
           $accountBalance = $accountBalance + (int)$form['amount'];

           $amount=[
            'account_balance'=>$accountBalance,
            'last_transaction'=>$form['amount'],

           ];
           $data =[
            'user_id' => $form['id'],
            'withdraw'=>0,
            'transfer'=>0,
            'deposit'=>$form['amount'],
            'account_balance'=>$accountBalance

           ];
//  return[ $data,$amount];

        DB::table('users')->where('id',$form['id'])->update($amount);



        DB::table('wallets')->insert($data);

        return response()->json([
            'success' => true,
            'message' => 'Deposit done successfully'
        ], 200);
      } catch (\Exception $e) {

        return response()->json([

            'success' => false,
            'error' => 'something went wrong.'.$e
        ], 500);
    }
    }



}
