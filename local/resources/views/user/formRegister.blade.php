@extends('user.layout')

@section('title', 'ĐĂNG KÝ')

@section('content')

	<div class="menu-sm">
		<div class="container">
			<ul class="nav">
				<li class="nav-item">
					<a href="/koibento/" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<span>
						Đăng ký
					</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="container register" style="padding: 100px 75px;">

		<h2 class="text-center text-uppercase"><img src='{{ asset("local/public/images/japan3.svg") }}' style="margin-bottom: 4px;">Đăng ký</h2>

		<form id="form_register" enctype="multipart/form-data" action="javascript:void(0)" method="post" name="form_register">

	        <p class="text-center" style="margin: 20px 0;"> Xin vui lòng điền đầy đủ thông tin dưới đây !</p>

	            @csrf

	            <div class="form-group row" style="margin-top: 1rem;">
	                <label class="col-sm-12 form-control-label text-xs-right" for="name" style="padding-bottom: 3px; font-weight: 500;"> Tên tài khoản : </label>
	                <div class="col-sm-12">
	                    <input type="text" class="form-control boxed" id="name" name="name" placeholder="Tên phải trong khoảng từ 8 đến 16 ký tự.">
	                    @if (count($errors) > 0)
	                    	<span class="text-danger">{{ $errors->first('name') }}</span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-12 form-control-label text-xs-right" for="password" style="padding-bottom: 3px; font-weight: 500;"> Mật khẩu : </label>
	                <div class="col-sm-12">
	                    <input type="password" class="form-control boxed" id="password" name="password" placeholder="Mật khẩu phải trong khoảng từ 8 đến 16 ký tự.">
	                    @if (count($errors) > 0)
	                    	<span class="text-danger">{{ $errors->first('password') }}</span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-12 form-control-label text-xs-right" for="password_again" style="padding-bottom: 3px; font-weight: 500;"> Nhập lại mật khẩu : </label>
	                <div class="col-sm-12">
	                    <input type="password" class="form-control boxed" id="password_again" name="password_again" placeholder=" Nhập lại mật khẩu.">
	                    @if (count($errors) > 0)
	                    	<span class="text-danger">{{ $errors->first('password') }}</span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-12 form-control-label text-xs-right" for="email" style="padding-bottom: 3px; font-weight: 500;"> Email đăng nhập:</label>
	                <div class="col-sm-12">
	                    <input type="text" class="form-control boxed" id="email" name="email" placeholder="Địa chỉ email ( dùng để đăng nhập ).">
	                    @if (count($errors) > 0)
	                    		<span class="text-danger">{{ $errors->first('email') }}</span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group row">
	                <label class="col-sm-12 form-control-label text-xs-right" for="phone" style="padding-bottom: 3px; font-weight: 500;"> Số điện thoại : </label>
	                <div class="col-sm-12">
	                    <input type="text" class="form-control boxed" id="phone" name="phone" placeholder="Số điện thoại liên lạc.">
	                    @if (count($errors) > 0)
	                   		 <span class="text-danger">{{ $errors->first('phone') }}</span>
	                	@endif	
	                </div> 
	            </div>

	            <div class="alert alert-success d-none" id="msg_div">
	              <span id="res_message"></span>
	    		</div> 

		        <div class="form-group row" style="display: flex; justify-content: center;">
		            <button type="submit" id="send_form" class="btn btn-danger" >Đăng ký</button>
		            <a href="/koibento/form/login" class="btn btn-primary" style="color:#fff; margin-left:20px;">Đăng nhập</a>
		        </div>

	    </form>

    </div>

@endsection