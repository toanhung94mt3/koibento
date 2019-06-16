<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\Product;
use App\User;
use App\Notification;

class CartController extends Controller
{

    public function addToCart($id)
    {

    	$product = Product::find($id);
    	$images = Product::find($id)->images;
    	foreach ($images as $image) {
    		$img = $image->name;
    	}

    	$carts = session()->get('cart');

    	if(!$carts){
    		$carts = [
    			$id => [
    				"id" => $product->id,
    				"title" => $product->title,
    				"image" => $img,
    				"quantity" => 1,
    				"price" => $product->price
    			]
    		];
    		session()->put('cart', $carts);
    		//session()->forget('carts');
    		return redirect()->back()->with('add_success', 'Bạn đã thêm sản phẩm " '.$product->title.' " vào giỏ hàng !');
    	}
    	if(isset($carts[$id])){
    		$carts[$id]['quantity']++;
    		session()->put('cart',$carts);
    		//session()->forget('carts');
    		return redirect()->back()->with('add_success', 'Bạn đã thêm sản phẩm " '.$product->title.' " vào giỏ hàng !');
    	}
    	$carts[$id] = [
    		"id" => $product->id,
    		"title"=>$product->title,
    		"image" => $img,
    		"quantity"=>1,
    		"price"=>$product->price
    	];
    	session()->put('cart', $carts);
    	//session()->forget('carts');
    		return redirect()->back()->with('add_success', 'Bạn đã thêm sản phẩm " '.$product->title.' " vào giỏ hàng !');

    }

    public function cart()
    {

    	return view('user.cart');

    }

    public function changeQuantity($id)
    {

    	$carts = session()->get('cart');

		if(isset($carts[$id])){
    		$carts[$id]['quantity'] = request('quantity');
    		session()->put('cart', $carts);
    		//session()->forget('cart');
    	}		
    	
    	return redirect()->back();
    }

    public function deleteCart($id)
    {

    	$carts = session()->get('cart');
    	//dd($carts[$id]);

		if(isset($carts[$id])){
    		unset($carts[$id]);
    		session()->put('cart', $carts);
    	}		
    	return redirect()->back();
    }

    public function confirmCart(Request $request)
    {

        $this->validate($request,[
            'phone_cart' => 'required | numeric',
            'date_cart' => 'required',
            'address_cart' => 'required'
            ],[
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.numeric' => 'Số không đúng định dạng',
            'date.required' => 'Bạn chưa nhập thời gian nhận hàng',
            'address.required' => 'Bạn chưa nhập địa chỉ nhận hàng'
            ]);

        $carts = session()->pull('cart');

        $total = 0;
        foreach ($carts as $cart) {
            $total +=  ( (int)$cart['price']*(int)$cart['quantity']);
        }
        
        //new order
        $order = new Order();
        
        if(Auth::check()){      //User
            $user = User::find(Auth::user()->id);
            /*$data = ['phone'=>$request->phone_cart, 'delivery_time'=>$request->date_cart, 'address'=>$request->address_cart, 'note'=>$request->note_cart, 'total'=>$total, 'user_id'=>$user->id];*/
            $order->phone = $request->phone_cart;
            $order->delivery_time = $request->date_cart;
            $order->address = $request->address_cart;
            $order->note = $request->note_cart;
            $order->total = $total;
            $order->user_id = $user->id;
        }
        else{       //Guest
            /*$data = ['phone'=>$request->phone_cart, 'delivery_time'=>$request->date_cart, 'address'=>$request->address_cart, 'note'=>$request->note_cart, 'total'=>$total];*/
            $order->phone = $request->phone_cart;
            $order->delivery_time = $request->date_cart;
            $order->address = $request->address_cart;
            $order->note = $request->note_cart;
            $order->total = $total;
        }

        /*$check = Order::insert($data);*/
        $order->save();

        //pivot table
        foreach ($carts as $cart) {
            $product = Product::find($cart['id']);
            $quantity = $cart['quantity'];
            $order->products()->attach($product->id, ['quantity'=>$quantity]);
        }

        //new notification
        $notification = new Notification();

        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $notification->user_id = $user->id;
        }else{
            $notification->user_id = 0;
        }

        $notification->save();

        //check
        if($order){ 
            $arr = array('message' => 'Quý khách đã đặt hàng thành công tại KOIBENTO ! Vui lòng chờ cuộc gọi xác nhận từ chúng tôi', 'status' => true);
            return Response()->json($arr);
        }
        elseif(!$order){
            $arr = array('message' => 'Đặt hàng không thành công !', 'status' => false);
            return Response()->json($arr);
        }

    }

    public function addToList($id)
    {

        //dd(Auth::user()->id);
        $user = User::find(Auth::user()->id);
        $product = Product::find($id);
        //dd($user->id);
        $checks = DB::table('product_user')
        ->where('user_id', '=', $user->id)
        ->get();

        foreach ($checks as $check) {
            if($check->product_id == $product->id){
                return back()
                ->with('like_error', 'Sản phẩm " '.$product->title.' " đã có trong danh mục ưa thích của bạn !');
            }
        }

        $user->products()->attach($product->id);

        return back()
        ->with('like_success', 'Bạn đã thêm thành công sản phẩm " '.$product->title.' " vào danh mục ưa thích !');

    }

    public function removeToList($id)
    {
        $user = User::find(Auth::user()->id);
        $product = Product::find($id);

        $user->products()->detach($product->id);
        return back()
        ->with('unlike_success', 'Bạn đã xóa sản phẩm " '.$product->title.' " ra khỏi danh mục ưa thích !');
    }

}
