<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Session;

use Redirect;

use Input;

use \App\User;

use \App\Transactions;

class BankController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    //
    //
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store()
  {
    //
  }
  
  /**
  * Reseting account
  *
  */
  public function resetaccount()
  {
    Transactions::truncate();
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id)
  {
    //Get account balance of this User from the database
    $balance = User::where('id', $id)->pluck('account_balance');

    //return balance results;
    return response($balance, 200)->header('Content-Type', 'text/plain');

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function update(Request $request, $id)
  {
    // Get user input amount
    $account_balance = $request->input('account_balance');

    //  Get amount transacted within current date
    $current_date       = date("Y-m-d");
    $todays_transaction = Transactions::where('user_id', $id)->where('transaction_type', 'Deposit')->where('transaction_date', $current_date)->sum('amount');

    // Find frequence of deposit within this day
    $transaction_count = Transactions::where('user_id', $id)->where('transaction_type', 'Deposit')->where('transaction_date', $current_date)->count();

    // Validating the limit transaction of the day whether it is over 150k, if it is terminate the transaction
    $totals = $todays_transaction + $account_balance;
    if($transaction_count < 4)
    {

      //  We do another validation to check amount per transaction is not more than 40k

      if($account_balance <= 40)
      {

        // Last validation is to ensure frequence of his deposit is not beyond 4
        if($totals <= 150)
        {

          //Updating and increasing the user account with the deposit amount
          $bank = User::find($id)->increment('account_balance', $account_balance);

          // Updating Transactions table with this transaction
          $transc = new Transactions;
          $transc->user_id            = 1;
          $transc->transaction_type   = 'Deposit';
          $transc->amount             = $account_balance;
          $transc->transaction_date   = date("Y-m-d");
          $transc->save();

          // response
          if($bank)
          {
            return response('Your account successfully credited.', 200)->header('Content-Type', 'text/plain');
          }else{
            return response('Error crediting your account.', 422)->header('Content-Type', 'text/plain');
          }

        }else{
          return response('Sorry! Deposit total per day is 150.', 403)->header('Content-Type', 'text/plain');
        }

      }else{
        return response('Deposit limit per transaction is 40 or less', 403)->header('Content-Type', 'text/plain');
      }

    }else{
      return response('Deposit frequence limit is 4 per day.', 403)->header('Content-Type', 'text/plain');
    }


  }


  /**
  * perform account deductions
  *
  * @param  int  $id
  * @return Response
  */
  public function deduct($id)
  {
    // Get user input amount
    $account_balance = Input::get('account_balance');

    //  Get amount transacted within current date
    $current_date       = date("Y-m-d");
    $total_deduct_transaction = Transactions::where('user_id', $id)->where('transaction_type', 'Deduct')->where('transaction_date', $current_date)->sum('amount');

    // Find frequence of deduction within this day
    $transaction_count  = Transactions::where('user_id', $id)->where('transaction_type', 'Deduct')->where('transaction_date', $current_date)->count();

    //  Todays transaction
    $todays_transaction = $total_deduct_transaction + $account_balance;

    // Get remaining account balance
    $account_total_amount = User::where('id', $id)->sum('account_balance');

    if($account_balance <= 20)
    {

      if($account_balance < $account_total_amount)
      {
        if($transaction_count < 3)
        {
          if($todays_transaction < 50)
          {
            //Updating and decreasing the user account with the amount requested amount
            $bank = User::find($id)->decrement('account_balance', $account_balance);

            // Updating Transactions table with this transaction
            $transc = new Transactions;
            $transc->user_id            = 1;
            $transc->transaction_type   = 'Deduct';
            $transc->amount             = $account_balance;
            $transc->transaction_date   = date("Y-m-d");
            $transc->save();

            // response
            if($bank)
            {
              return response('Your withdraw is successful.', 200)->header('Content-Type', 'text/plain');
            }else{
              return response('Error widthrawing from your account.', 422)->header('Content-Type', 'text/plain');
            }

          }else{
            return response('Your widthraw is above limit per day', 422)->header('Content-Type', 'text/plain');
          }
        }else{
          return response('You have reached maximum transaction limit', 403)->header('Content-Type', 'text/plain');
        }
      }else{
        return response('Not enough cash in your account to perform this transaction', 403)->header('Content-Type', 'text/plain');
      }

    }else{
      return response('Deposit limit per transaction is 20 or less', 403)->header('Content-Type', 'text/plain');
    }

  }


  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy($id)
  {
    //
  }






}
