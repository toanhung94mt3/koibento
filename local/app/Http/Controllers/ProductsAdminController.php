<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;

use App\Notification;
use App\Transaction;
use App\Category;
use App\Product;
use App\Order;
use App\Image;
use App\User;


class ProductsAdminController extends Controller
{

	public function index()
	{

		$categories = Category::all();

		$users = User::all();

		$products = Product::all();

		$sold = DB::table('products')
		->sum('sold');

		$total_income = DB::table('transactions')
		->sum('income');

		$order = Order::where('status', 0)->get();

		$checked_order = Order::where('status', 1)->get();

		$products5 = new Product();

		$products5 = DB::table('products')
		->orderBy('sold', 'DESC')
		->paginate(5);

		$images = Image::all();



		/*$transactions = Transaction::all()*/

		return view('admin.index', compact('categories','products','sold','total_income','products5','users','images','order','checked_order'));

	}

	public function productsList()
	{

		$products = new Product();

		$products = DB::table('products')
		->orderBy('created_at', 'DESC')
		->paginate(10);

		return view('admin.products', compact('products'));

	}

	public function search()
	{

        $query = request('txtSearchProduct');

        

        if($query == 'big')
        {
        	$products = DB::table('products')
        	->where('category_id', '=', 1)
	       	->get();
    	}
    	elseif($query == 'mini')
    	{
    		$products = DB::table('products')
        	->where('category_id', '=', 2)
	       	->get();
    	}
    	elseif($query == 'mini')
    	{
    		$products = DB::table('products')
        	->where('category_id', '=', 3)
	       	->get();
    	}
    	else
    	{
	    	$products = DB::table('products')
	        ->where('title', 'LIKE', "%{$query}%")
	        ->orWhere('category_id', 'LIKE', "%{$query}%")
	        ->orWhere('food_ingredients', 'LIKE', "%{$query}%")
	        ->orWhere('description', 'LIKE', "%{$query}%")
	        ->orWhere('price', 'LIKE', "%{$query}%")
	       	->take(30)
	       	->get();
    	}

    	return view('admin.search', compact('products'))
        	->with('query', $query);

	}

	public function creator()
	{
		$images = DB::table('images')
		->where('product_id', '=', NULL)
		->Where('used_as_slide', '=', 0)
		->get();

		return view('admin.creator', compact('images'));

	}

	public function create()
	{

		request()->validate([
			'title' => ['required', 'unique:products','min:3'],
			'category_id' => ['required'],
			'food_ingredients' => ['required'],
			'description' => ['required', 'max:500'],
			'price' => ['required', 'numeric'],
			'image' => ['required']
		]);

		$product = Product::create(request(['title','category_id','food_ingredients','description','price']));

		$id = request('image');

		$image = DB::table('images')
		->where('id','=', $id)
		->update(['product_id' => $product->id]);

		return redirect('/admin/products');

	}

	public function editor($id)
	{

		$product = Product::find($id);

		$imgs = DB::table('images')
		->where('product_id', '=', NULL)
		->Where('used_as_slide', '=', 0)
		->get();

		return view('admin.editor', compact('product', 'imgs'));

	}

	public function edit(Product $product)
	{

		request()->validate([
			'title' => ['required', 'min:3'],
			'category_id' => ['required'],
			'food_ingredients' => ['required'],
			'description' => ['required', 'min:3', 'max:255'],
			'price' => ['required', 'numeric']
		]);	

		$product->update(request(['title','category_id','food_ingredients','description','price']));

		$id = request('image');

		if($id == NULL){

			return back()
			->with('success', 'You have successfully edit product.');

		}else{

			$image = DB::table('images')
			->where('product_id','=', $product->id)
			->update(['product_id' => NULL]);

			$image = DB::table('images')
			->where('id','=', $id)
			->update(['product_id' => $product->id]);

			return back()
			->with('success', 'You have successfully edit product.');

		}

	}

	public function delete($id)
	{

		$product = Product::find($id);

		$product->delete();

		$image = DB::table('images')
		->where('product_id','=', $id)
		->update(['product_id' => NULL]);

		return redirect('admin/products');
	}

	public function getImage(Image $image)
    {

        return redirect('/admin/products/creator')

            ->with('image', asset("local/public/images/$image->name"))
            ->with('imageId', $image->id)
            ->with('imageName', $image->name);

    }

    public function getImageEditor(Image $img)
    {

        return back()

            ->with('img', asset("local/public/images/$img->name"))
            ->with('imgId', $img->id)
            ->with('imgName', $img->name);

    }
	
    public function autoLoad(){

    	$notifications = DB::table('notifications')
    	->where('status', '=', 0)
     	->orderBy('created_at', 'DESC')
     	->get();

     	$data = DB::table('notifications')
     	->where('status', '=', 0)
     	->orderBy('created_at', 'DESC')
     	->take(10)
     	->get();

     		$output = '<ul class="notifications-container">';

     		if(count($data) > 0)
     		{

		        foreach($data as $row)
		        {
		        	if($row->user_id == 0){
		        		$output .= '
					        <li class="notification-li">
					            <a id="'.$row->id.'" href="/koibento/admin/read" class="notification-item">
					                <div class="body-col">
					                    <p>
					                        <span class="accent"> Guest</span> placed an order !
					                    </p>
					                </div>
					            </a>
					        </li>
		           		';
		        	}else{
		        		$name_user = Notification::find($row->id);
		        		$output .= '
					        <li class="notification-li">
					            <a id="'.$row->id.'" href="/koibento/admin/read" class="notification-item">
					                <div class="body-col">
					                    <p>
					                        <span class="accent">'.$name_user->user->name.'</span> placed an order !
					                    </p>
					                </div>
					            </a>
					        </li>
		           		';
		        	}
		    	}

	        }
	        else
	        {
	        	$output .= '<li><a href="#" class="notification-item"><div class="body-col"><p> No notification found !</p></div></a></li>';
	        }

	        $output .= '</ul>';

        $arr = array('countmsg' => count($notifications), 'message' => $output);
        return Response()->json($arr);

    }

    public function readNotification(){

    	$notifications = DB::table('notifications')
    	->where('status', '=', 0)
     	->orderBy('created_at', 'ASC')
     	->take(10)
     	->get();

     	foreach($notifications as $notification){

     		$update = DB::table('notifications')
     		->where('id', '=',  $notification->id)
     		->update(['status' => 1]);

     	}

     	return redirect('/admin/orders/active');

    }

}