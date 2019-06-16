<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Category;
use App\Product;
use App\Image;
use App\Order;
use App\User;


class ProjectController extends Controller
{

    public function index()
    {

    	$hot_products = DB::table('products')->orderBy('sold')->take(8)->get();

    	$new_products = DB::table('products')->orderBy('created_at', 'DESC')->take(8)->get();

    	$images = DB::table('images')->orderBy('created_at')->take(6)->get();

        $slides = DB::table('images')->where('used_as_slide', 1)->get();

    	return view('user.index', compact('hot_products', 'new_products', 'images', 'slides'));

    }

    public function category($id)
    {

    	$category = Category::find($id);
    	$products = Product::where('category_id', $id)->orderBy('sold')->paginate(9);
    	$request = 1;

    	return view('user.category', compact('category','products','request'));

    }

    public function sort($id)
    {

    	$request = request('request');

    	$category = Category::find($id);

    	if($request == 1)
    	{

    		$products = Product::where('category_id', $id)->orderBy('sold')->get();

    	}
    	elseif($request == 2)
    	{

    		$products = Product::where('category_id', $id)->orderBy('created_at', 'DESC')->get();

    	}
    	else
    	{

    		$products = Product::where('category_id', $id)->orderBy('price')->get();

    	}

    	return view('user.sort', compact('category', 'products', 'request'));

    }

    public function aboutUs()
    {

    	return view('user.about-us');

    }

    public function infoUser()
    {

        if(Auth::check()){

            $user = User::find(Auth::user()->id);
            $products = User::find($user->id)->products;
            //$orders = User::find($user->id)->orders;
            $orders = DB::table('orders')
            ->where('user_id', '=', $user->id)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

            return view('user.infoUser', compact('user', 'products', 'orders'));

        }else{

            return view('user.error');

        }
       
    }

}