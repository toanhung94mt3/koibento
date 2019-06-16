<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>LOG IN</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
        <!-- Theme initialization -->
        <link rel="stylesheet" href="{{ asset('css/app-red.css') }}">
       
    </head>
    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">KOIBENTO ADMIN </h1>
                    </header>
                    <div class="auth-content">
                        <p class="text-center">Login to continue ...</p>
                         @if ($message = Session::get('fail'))
		                    <div class="alert alert-danger alert-block">
		                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
		                        <strong>{{ $message }}</strong>
		                    </div>
		                @endif
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

                        <form id="login-form" action="/koibento/admin" method="post">

                        	@csrf

                            <div class="form-group">
                                <label for="username">Email : </label>
                                <input type="email" class="form-control underlined" name="email" id="email" placeholder="Your user address" required autofocus> </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required> </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
       	<script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>