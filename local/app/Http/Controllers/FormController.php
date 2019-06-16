<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class FormController extends Controller
{

	public function formRegister()
    {  
        
        return view('user.formRegister');

    }

    public function register(Request $request)
    {  

        $this->validate($request,[
        'name' => 'required',
        'password' => 'required',
        'password_again' => 'required',
        'email' => 'required|unique:users',
        'phone' => 'required'
        ],[
        'name.required' => 'Bạn chưa nhập tên tài khoản.',
        'password.required' => 'Bạn chưa nhập mật khẩu.',
        'password_again.required' => 'Bạn chưa nhập lại mật khẩu.',
        'email.required' => 'Bạn chưa nhập email.',
        'email.unique:users' => 'Email đã tồn tại.',
        'phone.required' => 'Bạn chưa nhập số điện thoại.'
        ]);
         
        $data = ['name'=>$request->name, 'password'=>bcrypt($request->password), 'email'=>$request->email, 'phone'=>$request->phone];

        $check = User::insert($data);

        if($check){ 
        	$arr = array('message' => 'Chúc mừng bạn đã đăng ký tài khoản thành công !', 'status' => true);
        	return Response()->json($arr);
        }
        elseif(!$check){
        	$arr = array('message' => 'Đăng kí tài khoản không thành công !', 'status' => false);
        	return Response()->json($arr);
        }     
       
    }

     public function changePassword(Request $request)
    {  

        $this->validate($request,[
        'change_password_old' => 'required',
        'change_password_new' => 'required',
        'change_password_new_again' => 'required'
        ],[
        'change_password_old.required' => 'Bạn chưa nhập mật khẩu cũ.',
        'change_password_new.required' => 'Bạn chưa nhập mật khẩu mới.',
        'change_password_new_again.required' => 'Bạn chưa nhập lại mật khẩu mới.'
        ]);
        
        $user = User::find(Auth::user()->id);
        $password_new = bcrypt($request->change_password_new);

        Auth::logout();

        if (Auth::attempt(['email'=>$user->email, 'password'=>$request->change_password_old])){
       
            $user->password = $password_new;
            $user->save();

            $arr = array('message' => 'Đổi mật thành công !', 'status' => true);
                return Response()->json($arr);

        }
        else{

            $arr = array('message' => 'Mật khẩu không chính xác !', 'status' => false);
            return Response()->json($arr);

        }
       
    }

    public function formLogin()
    {  

        return view('user.formLogin');

    }

    public function login(Request $request)
    {  

        $this->validate($request,[
        'email_login' => 'required|email',
        'password_login' => 'required|min:8|max:16'
        ],[
        'email_login.required' => 'Bạn chưa nhập email.',
        'email_login.email' => 'Chưa đúng định dạng email',
        'password_login.required' => 'Bạn chưa nhập mật khẩu.',
        'password_login.min' => 'Độ dài mật khẩu trong khoảng từ 8 đến 16 ký tự.',
        'password_login.max' => 'Độ dài mật khẩu trong khoảng từ 8 đến 16 ký tự.',
        ]);
        
        if (Auth::attempt(['email'=>$request->email_login, 'password'=>$request->password_login])){
       
        	return redirect('/')
        	->with('login_success', 'Xin chào : '.Auth::user()->name.' . Chúc qúy khách ngon miệng !');

        }
        else{

        	return redirect('/form/login')
        	->with('login_fail', 'Email hoặc mật khẩu không chính xác.');

        }
       
    }

    public function logOut()
    {

    	Auth::logout();
    	return redirect('/form/login');

    }

    function searchSuggest(Request $request)
    {
        
        if($request->get('query'))
        {
            $query = request('query');

            if($query == 'bigbento')
            {

                $data = DB::table('products')
                ->where('category_id', '=', "1")
                ->take(10)
                ->get();

            }
            elseif($query == 'minibento')
            {

                $data = DB::table('products')
                ->where('category_id', '=', "2")
                ->take(10)
                ->get();

            }
            elseif($query == 'sushi')
            {

                $data = DB::table('products')
                ->where('category_id', '=', "3")
                ->take(10)
                ->get();

            }else{

                $data = DB::table('products')
                ->where('title', 'LIKE', "%{$query}%")
                ->orWhere('food_ingredients', 'LIKE', "%{$query}%")
                ->take(10)
                ->get();

            }
            
            $output = '<ul class="dropdown-menu" style="font-size:14px; display:block; position:relative; list-style-type: none; padding: 0.5rem 1rem;"><li>Tìm được '.count($data).' kết quả gần nhất cho từ khóa: " '.$query.' " !</li>';
            foreach($data as $row)
            {
               $output .= '
               <li><a href="#" data-toggle="modal" data-target="#modal-search-'.$row->id.'" >'.$row->title.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
           
       }

    }

}