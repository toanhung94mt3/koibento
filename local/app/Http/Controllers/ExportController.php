<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

use App\Order;
use App\User;

class ExportController extends Controller
{

  	public function exportUsers() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportTransactions() 
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }

    public function ExportOrders($id)
    {

    	$order = Order::find($id);
    	//dd($order->user->id);
    	if(isset($order->user->id)){
    		$data= ['id'=>'KOI'.$order->id.'GF#2D17',
	    			'time'=>$order->created_at,
	    			'name'=>$order->user->name,
	    			'total'=>$order->total
	    			];
    	}else{
    		$data= ['id'=>'KOI'.$order->id.'GF#2D17',
	    			'time'=>$order->created_at,
	    			'name'=>'Guest',
	    			'total'=>$order->total
	    			];
    	}

    	$products = Order::find($order->id)->products;
    	
    	//print_r($data);
		
    	$pdf = PDF::loadView('admin.exportOrder',  compact('data','products'));
    		return $pdf->download('exportOrder.pdf');

    }
    
}
