<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<link rel="stylesheet" href='{{ asset("css/bootstrap.min.css") }}'>
	<link rel="stylesheet" href='{{ asset("css/owl.carousel.min.css") }}'>
	<link rel="stylesheet" href='{{ asset("css/owl.theme.default.min.css") }}'>
	<link rel="stylesheet" href='{{ asset("css/all.min.css") }}'>
	<link rel="stylesheet" href='{{ asset("css/lightweightLightbox.css") }}'>
	<link rel="stylesheet" href='{{ asset("css/index.css") }}'>
</head>
<body>
	<?php
		$carts = session()->get('cart');
		//print_r($carts);
	?>
	<a id="goTop"><i class="fas fa-chevron-up"></i></a>
	<a href="https://www.facebook.com/koibentovietnam" id="fb"><i class="fab fa-facebook-f"></i></a>
	<div class="contact-top">
		<div class="container">
			<p>số điện thoại: 0974 704 288</p>
			<p class="marquee" style="text-transform:uppercase; font-weight:600;">Trung tâm Thương Mại Dịch vụ, Cổng 1B, khu VL1, Khu đô thị Vinaconex 3, Nam Từ Liêm, Hà Nội</p>
		</div>
	</div>
	<div class="nav-bar_rdw">
		<div>
			<div class="gi_cung_dc">
				<form action="javascript:void(0)" method="POSt" class="search_fix">
					@csrf
					<input class="searchInput" type="search" name="search_rdw" placeholder="search">
					
					<div>
						<button type="submit"><i class="fas fa-search"></i></button>
						<a class="close_search" href="javascript:void(0)"><i class="fas fa-times"></i></a>
					</div>
				</form>
			</div>
			
			<div id="searchList" class="searchList" style="width: 100%"></div>

			<div class="top_rdw">
				<div class="header_left_rdw">
					<a href="javascript:void(0)" title="menu" id="bar_show"><i class="fas fa-bars"></i></a>
					<div id="menu_none">
						<a href="javascript:void(0)" id="close"><i class="fas fa-times"></i></a>
						<ul>
							<li class="nav-item">
								<a href="/koibento/" title="Home" class="nav-link"><i class="fas fa-home"></i></a>
							</li>

							<?php
								$categories = App\Category::all();
								foreach ($categories as $category){
									?>

									<li class="nav-item">
										<a href="/koibento/category/{{ $category->id }}" title="Home" class="nav-link text-capitalize"> {{$category->title}} </a>
									</li>

									<?php
								}
							?>

							<li class="nav-item">
								<a href="/koibento/about-us" title="Về chúng tôi" class="nav-link text-uppercase">giới thiệu</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="header_right_rdw">
					<button class="search_button"><i class="fas fa-search"></i></button>
					<button class="user_button"><i class="fas fa-user"></i></button>
					<div id="uesr_none">
						<a href="javascript:void(0)" id="close_uesr"><i class="fas fa-times"></i></a>
						<ul class="uesr-nav">

							@if(Auth::check())
							<li><a >Xin chào: {{Auth::user()->name}}</a></li>
							<li><a href="/koibento/info">Thông tin tài khoản</a></li>
							<li><a href="/koibento/form/logout">Đăng xuất</a></li>
							@endif
							
							@if(!Auth::check())
							<li><a href="/koibento/form/login">Đăng nhập</a></li>
							<li><a href="/koibento/form/register">Đăng ký</a></li>
							@endif

						</ul>
					</div>
					<a class="cart_rdw" href="/koibento/cart"><i class="fas fa-cart-arrow-down"></i>
						<span class="oder_item-cart">
							<?php
								if(isset($carts)){
									$x = 0;
									foreach ($carts as $cart){	
										$x += (int)$cart['quantity'];
									}
									echo $x;
								}else echo '0';
							?>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end rdw header -->
	<div class="heder_top">
		<div class="container">
			<a href="/koibento/" class="logo">
				<img src='{{ asset("local/public/images/logo/logo.png") }}' alt="Home">
			</a>
			<div class="right_heder_top">

				<form action="javascript:void(0)" method="POST">
					@csrf
					<div class="search" style="position:relative;" >
						<input id="searchInput" class="searchInput" type="search" name="search" placeholder="Search..."> 
						<div id="searchList" class="searchList"></div>
						<button id="search_dow"><i class="fas fa-search"></i></button>
					</div>
				</form>

				<div class="add_cart">
					<a class="" href="/koibento/cart" title="Add Cart">
						<span><i class="fas fa-cart-arrow-down"></i></span>
						<span class="oder_item-cart">
						<?php
							if(isset($carts)){
								$x = 0;
								foreach ($carts as $cart){	
									$x += (int)$cart['quantity'];
								}
								echo $x;
							}else echo '0';
						?>
						</span>
					</a>
				</div>
				<div class="uers_login">
					<a href="javascript:void(0)" class="login_regiter"><span <?php if(Auth::check()){ echo 'style="background:#df0100;color: white;"';}?>><i class="fas fa-user"></i></span></a>
					<ul class="nav_login">

						@if(Auth::check())
						<li><a >Xin chào: {{Auth::user()->name}}</a></li>
						<li><a href="/koibento/info">Thông tin tài khoản</a></li>
						<li><a href="/koibento/form/logout">Đăng xuất</a></li>
						@endif
						
						@if(!Auth::check())
						<li><a href="/koibento/form/login">Đăng nhập</a></li>
						<li><a href="/koibento/form/register">Đăng ký</a></li>
						@endif

					</ul>
				</div>
				<!-- <a href="#">xin chào: <span>nguyễn null</span></a> -->
			</div>
		</div>
	</div>
	<!-- end header_top -->
	<div class="menu">
		<div class="container">
			<ul class="nav">
				<li class="nav-item">
					<a href="/koibento/" title="Home" class="nav-link"><i class="fas fa-home"></i></a>
				</li>

				<?php
					$categories = App\Category::all();
					foreach ($categories as $category){
						?>

						<li class="nav-item">
							<a href="/koibento/category/{{ $category->id }}" title="Home" class="nav-link text-capitalize">{{ $category->title }}</a>					
						</li>

						<?php
					}
				?>

				<li class="nav-item">
					<a href="/koibento/about-us" title="Về chúng tôi" class="nav-link text-uppercase">giới thiệu</a>
				</li>
				
			</ul>
		</div>
	</div>	

	@yield('content')

	<div class="footer">
		<div class="container">
			<div class="row">	
				<div class="col-4 text-center">
					<div class="box-one">
						<h3 class="text-uppercase" >Chính sách bán hàng</h3>
						<div class="sale-policy-block">
							<ul>
								<li>Giao hàng trong Hà Nội</li>
								<li>Miễn phí vận chuyển: <strong class="ng-binding"> Đơn hàng từ 5 món trở lên</strong></li>
								<li>Chất lượng đảm bảo</li>
								<li>Thanh toán khi nhận hàng</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-4 text-center">
					<p>					<img src='{{ asset("local/public/images/logo/logo.png") }}' alt=""></p>

				</div>
				<div class="col-4 text-center">
					<div class="box-two">
						<h3 class="text-uppercase" >Hướng Dẫn Mua Hàng</h3>
						<ul>
							<li>
								Mua hàng trực tiếp tại website
								<strong class="ng-binding"> http://www.koibento.vn</strong>
							</li>
							<li>
								Gọi điện thoại <strong class="ng-binding">
								0974 704 288
								</strong> để mua hàng
							</li>
							<li>
								Trung tâm Thương Mại Dịch vụ Trung Văn <br>
								<strong class="ng-binding">Cổng 1B, khu VL1, Khu đô thị Vinaconex 3, Nam Từ Liêm, Hà Nội</strong>
								<a href="https://www.google.com/maps/place/KOI+Bento+%E1%BA%A8m+th%E1%BB%B1c+Nh%E1%BA%ADt+B%E1%BA%A3n/@20.9946836,105.7787814,17.25z/data=!4m5!3m4!1s0x313453c082632f71:0x2786aae6d03f649b!8m2!3d20.9946426!4d105.7810038" target="_blank">Xem Bản Đồ</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="end text-center">KHP-supper © 2019</div>

	<!-- modal like error-->
	<div class="modal fade" id="modal-like-error">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                	<img src='{{ asset("local/public/images/japan1.svg") }}'>
                    <h4 class="modal-title">THÔNG BÁO </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body modal-tab-container">
                	 
                	<span>Bạn cần <a href="/koibento/form/login">đăng nhập</a> để có thể sử dụng tính năng này</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở lại</button>
                </div>
            </div>
    	</div>
	</div>
	<!-- /modal like error-->

	<!-- modal crazy search -->
	<?php $search_products = App\Product::all(); ?>
	@foreach($search_products as $search_product)
	<div class="modal fade" id="modal-search-{{$search_product->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                	<img src='{{ asset("local/public/images/japan.svg") }}'>
                    <h4 class="modal-title">Chi tiết sản phẩm - <em> {{$search_product->title}} </em> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body modal-tab-container">
                	<div class="row">
                		<div class="col-sm-12 col-md-6 col-xl-6">
                			<?php $search_images = App\product::find($search_product->id)->images; ?>
              				@foreach ($search_images as $search_image)
                			<img src='{{ asset("local/public/images/$search_image->name") }}' id="show-img" width="">
                			@endforeach
                		</div>
                		<div class="col-sm-12 col-md-6 col-xl-6">
                			<p><strong>Thành phần suất ăn</strong> : <em>{{$search_product->food_ingredients}}</em></p>
                			<p><strong>Mô tả</strong> : {{$search_product->description}}</p>
                			<p><strong>Giá</strong>  : <em><strong>{{$search_product->price}} VNĐ</strong></em></p>
                		</div>
                	</div>
                </div>
                <div class="modal-footer">
                	<form action="/koibento/cart/add-to-cart/{{ $search_product->id }}" method="post">
                		@csrf
                		@method('PATCH')
                		<button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i></button>
                	</form>
                	@if(Auth::check())
                	<form action="/koibento/cart/add-to-list/{{ $search_product->id }}" method="post">
                		@csrf
                		<button type="submit" class="btn btn-danger"><i class="fas fa-heart"></i></button>
                	</form>
                	@endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>

            </div>
    	</div>
	</div>
	@endforeach
	<!-- modal crazy search -->

    <!-- modal add_success -->
	@if ($add_success = Session::get('add_success'))
	<div class="modal fade" id="add_success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thành công</h4>
                </div>
                <div class="modal-body modal-tab-container">
                	<span>{{ $add_success }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Xác nhận</button>
                </div>
            </div>
    	</div>
	</div>
	@endif
	<!-- /modal add_success -->

	<!-- modal login_success -->
	@if ($login_success = Session::get('login_success'))
	<div class="modal fade" id="login_success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng nhập thành công</h4>
                </div>
                <div class="modal-body modal-tab-container">
                	<span>{{ $login_success }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Xác nhận</button>
                </div>
            </div>
    	</div>
	</div>
	@endif
	<!-- /modal login_success -->

	<!-- modal like_success -->
	@if ($like_success = Session::get('like_success'))
	<div class="modal fade" id="like_success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thành công</h4>
                </div>
                <div class="modal-body modal-tab-container">
                	<span>{{ $like_success }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Xác nhận</button>
                </div>
            </div>
    	</div>
	</div>
	@endif
	<!-- /modal like_success -->

	<!-- modal unlike_success -->
	@if ($unlike_success = Session::get('unlike_success'))
	<div class="modal fade" id="unlike_success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body modal-tab-container">
                	<span>{{ $unlike_success }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Xác nhận</button>
                </div>
            </div>
    	</div>
	</div>
	@endif
	<!-- /modal unlike_success -->

	<!-- modal like_error -->
	@if ($like_error = Session::get('like_error'))
	<div class="modal fade" id="like_error">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body modal-tab-container">
                	<span>{{ $like_error }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Xác nhận</button>
                </div>
            </div>
    	</div>
	</div>
	@endif
	<!-- /modal like_error -->

	<!-- modal cart_update_success -->
	<div class="modal fade" id="cart_update_success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><em>ĐẶT HÀNG THÀNH CÔNG !</em></h4>
                </div>
                <div class="modal-body modal-tab-container">
                	@if(Auth::check())
                	<span> Giỏ hàng sẽ tự động cập nhật sau 15 giây ! Qúy khách có thể <a href="/koibento/info">Kiểm tra các đơn hàng</a></span>
                	@endif
                	@if(!Auth::check())
                	<span>  Giỏ hàng sẽ tự động cập nhật sau 15 giây ! Qúy khách có thể <a href="/koibento/form/register">Đăng ký</a>
                	để có cơ hội nhận được những ưu đãi hấp dẫn cũng như các tính năng thú vị khác từ chúng tôi !</span>
                	@endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Trở lại</button>
                </div>
            </div>
    	</div>
	</div>
	<!-- /modal cart_update_success -->

	<script src='{{ asset("js/jquery-3.3.1.min.js") }}'></script>
	<script src='{{ asset("js/popper.min.js") }}'></script>
	<script src='{{ asset("js/bootstrap.min.js") }}'></script>
	<script src='{{ asset("js/owl.carousel.min.js") }}'></script>
	<script src='{{ asset("js/all.min.js") }}'></script>
	<script src='{{ asset("js/marquee.js") }}'></script>
	<script src='{{ asset("js/jquery.nice-select.min.js") }}'></script>
	<script src='{{ asset("js/lightweightLightbox.min.js") }}'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

  	<script src='{{ asset("js/index.js") }}'></script>

  	

	@if(isset($add_success))
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#add_success').modal('show');
	    });
	</script>
	@endif

	@if(isset($login_success))
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#login_success').modal('show');
	    });
	</script>
	@endif

	@if(isset($like_success))
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#like_success').modal('show');
	    });
	</script>
	@endif

	@if(isset($unlike_success))
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#unlike_success').modal('show');
	    });
	</script>
	@endif

	@if(isset($like_error))
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#like_error').modal('show');
	    });
	</script>
	@endif
	
</body>
</html>