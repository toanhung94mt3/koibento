<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Order;
use App\User;
use App\Product;
use App\Transaction;


class OrderAdminController extends Controller
{
    
	public function order()
	{
		$orders = Order::where('status', 0)->get();

		$users = User::all();

		return view('admin.orders', compact('orders', 'users'));

	}

	public function check($id)
	{

		//change order's status
		$order = Order::find($id);
		$order->status = 1;

		$id_admin = Auth::guard('admin')->id();
        $admin = User::find($id_admin);
		$order->admin_check = $admin->name;

		$order->save();

		//new transaction
		$transaction = new Transaction();

		$total = request('total');
		$x = (int)$total;

		$deal = request('get_deal');
		$y = (int)$deal;

		$z = $x - $x*$y/100;

		$transaction->order_id = $order->id;
		$transaction->customer = request('customer');
		$transaction->total = $total;
		$transaction->deal = $deal;
		$transaction->income = $z;

		$transaction->save();

		//update product
		$products = Order::find($order->id)->products;
		foreach($products as $product ){
			$product->sold += $product->pivot->quantity;
			$product->save();
		}

		//update user		
		if($order->user_id == 0){		//guest
			return back()
			->with('check_success', 'You have successfully check complete this order.');
		}else{							//user
			$user = User::find($order->user_id);
			$user->total_payment += $z;
			$user->save();
			return back()
			->with('check_success', 'You have successfully check complete this order.');
		}

	}

	public function remove($id)
	{

		$order = Order::find($id);

		$order->products()->detach();

		$order->delete();

		return back()
		->with('remove_success', 'You have successfully remove user.');

	}

	public function history()
	{
		$orders = Order::where('status', 1)->get();

		$users = User::all();

		return view('admin.history', compact('orders', 'users'));

	}

	public function delete()
	{

		$orders = Order::where('status', 1)->get();

		foreach($orders as $order){
			$order->delete();
		}

		return back()
		->with('delete_success', 'You have successfully delate all history.');

	}

	

}
