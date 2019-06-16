@extends('user.layout')

@section('title', 'ĐĂNG NHẬP')

@section('content')

	<div class="menu-sm">
		<div class="container">
			<ul class="nav">
				<li class="nav-item">
					<a href="/koibento/" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<span>
						Đăng nhập
					</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="container register" style="padding: 100px 110px;">

		<h2 class="text-center text-uppercase"><img src='{{ asset("local/public/images/japan12.svg") }}' style="margin-bottom: 10px;">Đăng nhập</h2>

		<p class="text-center" style="margin: 20px 0;"> KOIBENTO xin chào quý khách !</p>

		<form id="" enctype="multipart/form-data" action="/koibento/form/login" method="post" name="form_login">

	            @csrf

	            <div class="form-group row" style="margin-top: 1rem;">
	                <label class="col-sm-12 form-control-label text-xs-right" for="email_login" style="padding-bottom: 3px; font-weight: 500;"> Email : </label>
	                <div class="col-sm-12">
	                    <input type="text" class="form-control boxed" id="email_login" name="email_login" placeholder="Vui lòng nhập email của bạn." required autofocus>
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-12 form-control-label text-xs-right" for="password_login" style="padding-bottom: 3px; font-weight: 500;"> Mật khẩu : </label>
	                <div class="col-sm-12">
	                    <input type="password" class="form-control boxed" id="password_login" name="password_login" placeholder="Mật khẩu phải trong khoảng từ 8 đến 16 ký tự." required>
	                </div>
	            </div>

	            @if($errors->any())
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>     
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>  
                </div>
                @endif

                @if ($login_fail = Session::get('login_fail'))
					<div class="alert alert-danger alert-block">{{$login_fail}}</div>
				@endif
	       		
	    		<p class="text-center" style="margin: 20px 0;"> Quý khách chưa có tài khoản? Hãy <a href="/koibento/form/register" >đăng ký </a> tài khoản để có cơ hội nhận được những ưu đãi hấp dẫn cũng như trải nhiệm các tính năng thú vị khác từ KOIBENTO !</p>

		        <div class="form-group row" style="display: flex; justify-content: center;">
		            <button type="submit" class="btn btn-primary"> Đăng nhập </button>
		        </div>

	    </form>

    </div>

@endsection