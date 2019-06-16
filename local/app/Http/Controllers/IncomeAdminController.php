<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Transaction;




class IncomeAdminController extends Controller
{
    
	public function table()
	{
		
		$transactions = Transaction::all();

		$total_income = DB::table('transactions')
		->sum('income');


		return view('admin.income', compact('transactions', 'total_income'));

	}

	public function delete($id)
	{

		$transaction = Transaction::find($id);

		$transaction->delete();

		return back()
		->with('delete_success', 'You have successfully delete record.');

	}

}
