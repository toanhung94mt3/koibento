<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileAdminController extends Controller
{
    public function list()
    {

    	$users = User::all();

    	return view('admin.usersList', compact('users'));

    }

    public function create(Request $request)
    {
        request()->validate([
			'name' => ['required', 'min:8', 'max:16'],
			'password' => ['required','min:8', 'max:16'],
			'passwordAgain' => ['required', 'same:password'],
			'level' => ['required'],
			'get_deal' => ['required', 'numeric', 'max:99'],
			'email' => ['required', 'unique:users', 'email'],
			'phone' => ['required', 'numeric', 'min:10']
		]);

		$user = new User;
		$user->name = request('name');
		$user->password = bcrypt(request('password'));
		$user->level = request('level');
		$user->get_deal = request('get_deal');
		$user->email = request('email');
		$user->phone = request('phone');
		$user->save();

		return back()
		->with('create_success', 'You have successfully create user.');;
    }

    public function edit($id)
    {
        $user = User::find($id);

        if($user->level != 'Superadmin'){

            request()->validate([
                'name' => ['required', 'min:8', 'max:16'],
                'password' => ['required','min:8', 'max:16'],
                'level' => ['required'],
                'get_deal' => ['required', 'numeric', 'max:99'],
                'phone' => ['required', 'numeric', 'min:10']
            ]);

            $user->name = request('name');
            $user->password = bcrypt(request('password'));
            $user->level = request('level');
            $user->get_deal = request('get_deal');
            $user->phone = request('phone');
            $user->save();

        }else{

             request()->validate([
                'name' => ['required', 'min:8', 'max:16'],
                'level' => ['required'],
                'get_deal' => ['required', 'numeric', 'max:99'],
                'phone' => ['required', 'numeric', 'min:10']
            ]);

            $user->name = request('name');
            $user->level = request('level');
            $user->get_deal = request('get_deal');
            $user->phone = request('phone');
            $user->save();

        }
        
		return back()
		->with('edit_success', 'You have successfully edit user.');
    }

    public function delete($id)
    {

    	$user = User::find($id);

		$user->delete();

		return back()
		->with('delete_success', 'You have successfully delete user.');

    }

    public function logInPage()
    {

    	return view('admin.logIn');

    }

    public function logIn(Request $request)
    {

    	request()->validate([
			'email' => ['required', 'email'],
			'password' => ['required','min:8', 'max:16'],
		]);

		$users = DB::table('users')
	    ->where('email', $request->email)->get();
    	foreach ($users as $user){
    		$level = $user->level;
    	}

        if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password])){

        	if($level == 'admin' | $level == 'Superadmin'){
        		return redirect('/admin/index');
        	}
        	else{
        		return redirect('/admin/')
        		->with('fail', 'You are not Admin');
        	}
        
        }
        else{
        	return redirect('/admin/')
        	->with('fail', 'Wrong password entered');
        }
        
    }

    public function logOut()
    {

    	Auth::logout();
    	return redirect('/admin/');

    }


}