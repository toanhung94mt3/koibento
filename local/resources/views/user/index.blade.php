@extends('user.layout')

@section('title', 'INDEX')

@section('content')

	<div id="koicarosel" class="owl-carousel owl-theme" >

		@foreach($slides as $slide)
		<div class="item">
			<div><img src='{{ asset("local/public/images/$slide->name") }}' alt="sl1"></div>
			<div class="charater">
				<p id="">khi ẩm thực nhật bản <span>bắt đầu từ lòng</span> yêu thương</p>
			</div>
		</div>
		@endforeach
	</div>
	<!-- end slide_koi -->
	<div class="ad container">
		<div class="row">
			<div class="col-4 text-center">
				<div>
					<p><i class="fas fa-carrot" style="width: 4rem; height:auto;"></i></p>
					<span>thực phẩm tươi mới</span>
					<p>Tất cả thực phẩm được sử dụng đều là tươi mới cho những món ăn với chất lượng tốt nhất.</p>
				</div>
			</div>
			<div class="col-4 text-center">
				<div>
					<p><i class="fas fa-drumstick-bite" style="width: 4rem; height:auto;"></i></p>
					<span>ngon miệng</span>
					<p>Mang tới cho bạn những bữa trưa ngon miệng sau giờ làm việc vất vả.</p>
				</div>
			</div>
			<div class="col-4 text-center">
				<div style="padding-top:7px;">
					<p><i class="fas fa-piggy-bank" style="width: 4rem; height:auto;"></i></p>
					<span>tiết kiệm & tiện lợi</span>
					<p>Giúp bạn có bữa trưa tiết kiệm và tiện lợi khi <a href="/koibento/form/register" >đăng ký thành viên </a>và đặt món từ <span>KOIBENTO.</span></p>
				</div>
			</div>
		</div>	
	</div>
	<!-- end ad -->
	<div class="eating">
		<div class="container">
			<ul class="tabs">
				<li>
					<a href="#eat" title="Bigbento"></a><span> Nổi bật </span>
				</li>
				<li>
					<a href="#eat1" title="Small"></a><span> Mới </span>
				</li>
			</ul>
			<div class="row tab-content" id="eat">

				<!--product item-->
				@foreach($hot_products as $hot_product)

				<div class="item col-3">
					<div class="item-eat">

						<?php

							$hot_images = App\product::find($hot_product->id)->images;

							foreach ($hot_images as $hot_image){

								?>
								
								<a href="" title="Xem Chi Tiết" data-toggle="modal" data-target="#modal-search-{{$hot_product->id}}">
									<img class="lazy" data-src='{{ asset("local/public/images/$hot_image->name") }}' alt="1eating">
									<span class="">Hot</span>
								</a>

								<div class="vnd">
									<a href="" title="Mua" data-toggle="modal" data-target="#modal-search-{{$hot_product->id}}">
										<i class="far fa-eye"></i>
									</a>
									@if(Auth::check())
									<a href="#" title="Yêu Thích" id="" data-toggle="modal" data-target="#modal-like-{{$hot_product->id}}"><i class="fas fa-heart"></i></a>
									@endif
									@if(!Auth::check())
									<a href="#" title="Yêu Thích" id="" data-toggle="modal" data-target="#modal-like-error" ><i class="fas fa-heart"></i></a>
									@endif
								</div>

								<!-- modal like-->
								<div class="modal fade" id="modal-like-{{$hot_product->id}}">
					                <div class="modal-dialog">
					                    <div class="modal-content">
					                        <div class="modal-header">
					                        	<img src='{{ asset("local/public/images/japan6.svg") }}'>
					                            <h4 class="modal-title"><em> XÁC NHẬN </em> </h4>
					                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                <span aria-hidden="true">&times;</span>
					                                <span class="sr-only">Close</span>
					                            </button>
					                        </div>
				                            <div class="modal-body modal-tab-container">
				                            	 
			                                	<span>Thêm sản phẩm - {{$hot_product->title}} - vào danh sách ưa thích</span>
				                            </div>
				                            <div class="modal-footer">
				                            	<form action="/koibento/cart/add-to-list/{{ $hot_product->id }}" method="post">
				                            		@csrf
				                            		<button type="submit" class="btn btn-primary"> Xác nhận</button>
				                            	</form>
				                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
				                            </div>
					                    </div>
				                	</div>
				            	</div>
				            	<!-- /modal like-->

								<?php

							}

						?>
							
					</div>
					<div class="name_and">
						<a href="#">{{$hot_product->title}}</a>
						<p>{{$hot_product->price}}</p>
					</div>
				</div>

				

				@endforeach
				<!--/product item-->

			</div>


			<div class="row tab-content" id="eat1">
				<!--product item-->
				@foreach($new_products as $new_product)

				<div class="item col-3">
					<div class="item-eat">

						<?php

							$new_images = App\product::find($new_product->id)->images;

							foreach ($new_images as $new_image) {

								?>

								<a href=""  title="Xem Chi Tiết" data-toggle="modal" data-target="#modal-search-{{$hot_product->id}}">
									<img class="lazy" data-src='{{ asset("local/public/images/$new_image->name") }}' alt="1eating" >
									<span class=" new">New</span>
								</a>
								<div class="vnd">
									<a href="#" title="Mua" data-toggle="modal" data-target="#modal-search-{{$new_product->id}}">
										<i class="far fa-eye"></i>
									</a>
									@if(Auth::check())
									<a href="#" title="Yêu Thích" id="" data-toggle="modal" data-target="#modal-like-{{$new_product->id}}"><i class="fas fa-heart"></i></a>
									@endif
									@if(!Auth::check())
									<a href="#" title="Yêu Thích" id="" data-toggle="modal" data-target="#modal-like-error" ><i class="fas fa-heart"></i></a>
									@endif
								</div>

								<!-- modal like-->
								<div class="modal fade" id="modal-like-{{$new_product->id}}">
					                <div class="modal-dialog">
					                    <div class="modal-content">
					                        <div class="modal-header">
					                        	<img src='{{ asset("local/public/images/japan6.svg") }}'>
					                            <h4 class="modal-title"><em> XÁC NHẬN </em> </h4>
					                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                <span aria-hidden="true">&times;</span>
					                                <span class="sr-only">Close</span>
					                            </button>
					                        </div>
				                            <div class="modal-body modal-tab-container">
				                            	 
			                                	<span>Thêm sản phẩm - {{$new_product->title}} - vào danh sách ưa thích</span>
				                            </div>
				                            <div class="modal-footer">
				                            	<form action="/koibento/cart/add-to-list/{{ $new_product->id }}" method="post">
				                            		@csrf
				                            		<button type="submit" class="btn btn-primary"> Xác nhận</button>
				                            	</form>
				                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
				                            </div>
					                    </div>
				                	</div>
				            	</div>
				            	<!-- /modal like-->

								<?php

							}

						?>

					</div>
					<div class="name_and">
						<a href="file:///D:/koidemo/shopping.html">{{ $new_product->title }}</a>
						<p>{{ $new_product->price }}</p>
					</div>
				</div>
				@endforeach
				<!--/product item-->
			</div>
		</div>
	</div>
	<!-- end eating -->	
	<div class="adt">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<div class="adt-item">
						<p class="text-uppercase text-center">Thời gian đặt hàng</p>
						<ul class="nav">
							<li class="nav-item">
								<span class="text-uppercase">thứ hai</span>
								<span class="text-uppercase"> Trước 11:30h sáng</span>
							</li>
							<li class="nav-item">
								<span class="text-uppercase">thứ ba</span>
								<span class="text-uppercase"> Trước 11:30h sáng</span>
							</li>
							<li class="nav-item">
								<span class="text-uppercase">thứ tư</span>
								<span class="text-uppercase"> Trước 11:30h sáng</span>
							</li>
							<li class="nav-item">
								<span class="text-uppercase">thứ năm</span>
								<span class="text-uppercase"> Trước 11:30h sáng</span>
							</li>
							<li class="nav-item">
								<span class="text-uppercase">thứ sáu</span>
								<span class="text-uppercase"> Trước 11:30h sáng</span>
							</li>
							<li class="nav-item">
								<span class="text-uppercase">thứ bảy</span>
								<span class="text-uppercase"> Trước 11:30h sáng</span>
							</li>
						</ul>
					</div>
				</div>	
				<div class="col-4">
					<div class="adt-item">
						<p class="text-uppercase text-center">ĐỊA CHỈ</p>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7449.874817542563!2d105.78024201338033!3d20.99514596644792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313453c082632f71%3A0x2786aae6d03f649b!2zS09JIEJlbnRvIOG6qG0gdGjhu7FjIE5o4bqtdCBC4bqjbg!5e0!3m2!1svi!2s!4v1556095048497!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						<p>
							Trung tâm Thương Mại Dịch vụ, Cổng 1B, khu VL1, Khu đô thị Vinaconex 3, Nam Từ Liêm, Hà Nội
						</p>
						<a href="https://www.google.com/maps/place/KOI+Bento+%E1%BA%A8m+th%E1%BB%B1c+Nh%E1%BA%ADt+B%E1%BA%A3n/@20.9971981,105.7746204,15z/data=!4m5!3m4!1s0x0:0x2786aae6d03f649b!8m2!3d20.9948555!4d105.7813149" class="text-capitalize">bản đổ <span><i class="fas fa-long-arrow-alt-right"></i></span></a>
					</div>
				</div>
				<div class="col-4">
					<div class="adt-item">
						<p class="text-uppercase text-center">liên hệ</p>
						<ul class="nav">
							<li class="nav-item">
								<span class="text-uppercase">điện thoại</span>
								<p>0985765344</p>
							</li>
							<li class="nav-item">
								<span class="text-capitalize">facebook</span>
								<p>facebook.com/koibentovietnam</p>
							</li>
							<li class="nav-item">
								<span class="text-capitalize">email</span>
								<p>info@koibento.com</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end ads shop -->
	<div class="picture">
		<div class="text-center eating_top"><span class="text-uppercase">Thư viện</span></div>
		<div class="row-picture lightbox-container">

			@foreach($images as $image)

			<div class="box">
				<span><img alt="An example image 1" class="lightbox-image lazy" data-src='{{ asset("local/public/images/$image->name") }}'></span>
			</div>

			@endforeach
			
		</div>
	</div>
	<!-- end eating1 -->

@endsection