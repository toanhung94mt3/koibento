@extends('user.layout')

@section('title', "$category->title")

@section('content')

	<div class="menu-sm">
		<div class="container">
			<ul class="nav">
				<li class="nav-item">
					<a href="/koibento/" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<span>
						{{ $category->title }}
					</span>
				</li>
			</ul>
		</div>
	</div>

	<!-- end menu -->
	<div class="item-menu">
		<div class="container">
			<h2 class="text-uppercase text-center">
				@if($category->id == 1)
					<img src='{{ asset("local/public/images/japan9.svg") }}' style="margin-bottom: 7px;">
				@elseif($category->id == 2)
					<img src='{{ asset("local/public/images/japan10.svg") }}' style="margin-bottom: 7px;">
				@else
					<img src='{{ asset("local/public/images/japan11.svg") }}' style="margin-bottom: 7px;">
				@endif
				{{ $category->title }}
			</h2>
			<div class="row">
				<div class="col-3">
					<div id="sticky">
						<div class="item"><a href="#"><img src='{{ asset("local/public/images/ads-menu2.jpg") }}' alt="ads"></a></div>
					</div>
				</div>
				<div class="col-9">
					<div class="select">
						<div class="select-left">
							<p>sắp xếp theo</p>
							<div class="box">

								<form action="/koibento/category/{{ $category->id }}" method="post" id="form_sort" name="sortForm">
									@csrf
										
									<select id="position" onchange="sortForm.submit()" name="request">

										<option value="1" <?php if($request == 1){ echo 'selected'; } ?> title="Sản phẩm bán chạy"> Hot </option>
										<option value="2" <?php if($request == 2){ echo 'selected'; } ?> title="Sản phẩm mới"> New </option>
										<option value="3" <?php if($request == 3){ echo 'selected'; } ?> title="Giá sản phẩm "> Giá </option>

									</select>
								</form>

							</div>
						</div>
					</div>	
					<!-- end select -->
					<div class="item-produt">

						@foreach($products as $product)

						<div class="item">	
							<div class="item-top">

								<?php

									$images = App\product::find($product->id)->images;

									foreach($images as $image){

										?>
			
										<a href="#" data-toggle="modal" data-target="#modal-search-{{$product->id}}" ><img src='{{ asset("local/public/images/$image->name") }}' alt="item-menu"></a>
										<div class="add-pay">
											<a href="#" title="thêm vào giỏ hàng" data-toggle="modal" data-target="#modal-search-{{$product->id}}"><i class="far fa-eye"></i></a>
											@if(Auth::check())
											<a href="#" title="Yêu Thích" id="" data-toggle="modal" data-target="#modal-like-{{$product->id}}"><i class="fas fa-heart"></i></a>
											@endif
											@if(!Auth::check())
											<a href="#" title="Yêu Thích" id="" data-toggle="modal" data-target="#modal-like-error" ><i class="fas fa-heart"></i></a>
											@endif
										</div>

										<!-- modal like-->
										<div class="modal fade" id="modal-like-{{$product->id}}">
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
						                            	 
					                                	<span>Thêm sản phẩm - {{$product->title}} - vào danh sách ưa thích</span>
						                            </div>
						                            <div class="modal-footer">
						                            	<form action="/koibento/cart/add-to-list/{{ $product->id }}" method="post">
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
							<div class="item-bot">
								<a href="#">{{ $product->title }}</a>
								<p>{{ $product->price }} VNĐ</p>
							</div>
							<p>{{ $product->food_ingredients}}</p>
						</div>

						@endforeach

					</div>
					<div style="display: flex; justify-content: center;">
						{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection