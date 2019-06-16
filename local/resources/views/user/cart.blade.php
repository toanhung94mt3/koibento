@extends('user.layout')

@section('title', 'CART')

@section('content')

	<div class="menu-sm">
		<div class="container">
			<ul class="nav">
				<li class="nav-item">
					<a href="/koibento/" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<span>
						Giỏ hàng
					</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="shopping">
		<h2 class="text-center text-uppercase">
		<img src='{{ asset("local/public/images/japan13.svg") }}' style="margin-bottom: 7px;">
		giỏ hàng
		</h2>
		<div class="container no-item">
			<?php
				$carts = session()->get('cart');
				if(!isset($carts) | (isset($carts) && count($carts) == 0)){
					?>
					<p>Không có món nào trong giỏ hàng</p>
					<?php
				}
			?>
			<p>Nhấn <a href='/koibento/'>vào đây</a> để tiếp tục mua sắm</p>

			<!-- errors message -->
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
            <!-- /errors message -->
         
		</div>

		<div class="container shop-item">
			<div class="row">
				<div class="col-6">

				@if(isset($carts))

					<?php $total_price = 0; ?>

					@foreach($carts as $cart)

					<ul class="item-oder">
                        <li>
                            <div class="oder-left">
                                <a href="#"><img src='{{ asset("local/public/images/$cart[image]") }}' alt="cart-oder"></a>

                                <form action="/koibento/cart/quantity/{{ $cart['id'] }}" method="post" id="quantity_form" name="">

                                	@method('PATCH')
                                	@csrf

                                    <span style="color: #fd0102">{{$cart['title']}}</span>

                                    <div>
                                        <div class="group_btn">
                                            <input type="submit" class="down" value="-" data-min="1"/>
                                            <input type="text" class="incdec" value="{{ $cart['quantity'] }}" id = "quantity" name="quantity"
                                            onchange="this.form.submit()" />
                                            <input type="submit" class="up" value="+" data-max="50"/>
                                        </div>

                                        <p><span>x</span><span class="text-uppercase"> {{ $cart['price'] }} VNĐ</span></p>
                                        <a href="" class="remove-oder-item" title="xóa" data-toggle="modal" data-target="#cart-delete-{{ $cart['id'] }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>

                                </form>

                            </div>

                            <div class="modal fade" id="cart-delete-{{ $cart['id'] }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Cảnh báo </h4>
                                        </div>
                                        <div class="modal-body modal-tab-container">
                                            <span>
                                                Bạn có chắc chắn muốn xóa sản phẩm " {{ $cart['title'] }} " ra khỏi giỏ hàng
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/koibento/cart/quantity/{{ $cart['id'] }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></i> Xóa sản phẩm</button>
                                            </form>
                                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Trở Lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    	</li>

		            </ul>

		            <?php   	
		            	$total_price += (int)$cart['price']*(int)$cart['quantity'];
		            ?>
		            
		            @endforeach

				@endif

				</div>
				<div class="col-6">
					<div class="oder-pay">
						<p class="text-uppercase">tổng đơn</p>
						<p><span>tổng tiền</span>
							<span class="text-uppercase" id="all-pay">
								<?php
									if(isset($carts)){
										echo $total_price.'.000 VNĐ';
									}else echo '0 VNĐ';
								?>
							</span>
						</p>
						<div class="text-center pay-oder">
							<a href="" id="checkout" data-toggle="modal" data-target="#modal-cart-confirm"><span><i class="fas fa-shipping-fast"></i></span>đặt hàng</a>
							<a href="/koibento/info" id="update"><span><i class="fas fa-redo"></i></span>Đơn hàng đã đặt</a>
							<a href="/koibento/" id="continue"><span><i class="fas fa-reply"></i></span>tiếp tục chọn món</a>		
						</div>
					</div>
				</div>

				<!-- modal card confirm -->
				@if(isset($cart) && count($carts) > 0)

				<div class="modal fade" id="modal-cart-confirm">
	                <div class="modal-dialog modal-lg">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                        	<img src='{{ asset("local/public/images/japan8.svg") }}'>
	                            <h3 class="modal-title text-center"> Xác nhận đơn đặt hàng</h3>
	                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                                <span class="sr-only">Close</span>
	                            </button>
	                        </div>

	                        <!-- modal card form -->
	                        <form id="form_cart_confirm" enctype="multipart/form-data" action="javascript:void(0)" method="post">
	                        	
	                        	@csrf

	                            <div class="modal-body modal-tab-container">
	                            	<p> Xin vui lòng điền đầy đủ thông tin để xác thực yêu cầu của quý khách !</p>

	                            	<div class="form-group row" style="margin-top: 1rem;">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="phone_cart"> Số điện thoại <span class="text-danger"> * </span> : </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control boxed" id="phone_cart" name="phone_cart" placeholder=" Vui lòng nhập số điện thoại liên lạc hiện tại của bạn."></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="date_cart"> Thời gian giao hàng <span class="text-danger"> * </span> : </label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control boxed" id="date_cart" name="date_cart"></div>     
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="address_cart"> Địa chỉ giao hàng <span class="text-danger"> * </span> : </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control boxed" id="address_cart" name="address_cart" placeholder="Vui lòng nhập địa chỉ nhận hàng ( Số nhà - Ngõ/Ngách - Đường - Phường/Quận/Huyện )."></div>       
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="note_cart"> Yêu cầu :  </label>
                                        <div class="col-sm-9">
                                        	<textarea class="form-control boxed" id="note_cart" name="note_cart" placeholder="Lời nhắn, những yêu cầu hoặc chú ý đặc biệt kèm theo của bạn."></textarea>
                                        </div>
                                    </div>
                                    <div class="alert alert-success d-none" id="msg_div">
						              	<span id="res_message"></span>
						    		</div> 
	                            </div>

	                            <div class="modal-footer">
                            		<button type="submit" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> Xác Nhận </button>
	                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
	                            </div>

                        	</form>
                        	<!-- /modal card form -->

	                    </div>
                	</div>
            	</div>
            	@endif

            	@if(!isset($cart) | (isset($cart) && count($carts) == 0) )

				<div class="modal fade" id="modal-cart-confirm">
	                <div class="modal-dialog modal-lg">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                        	<img src='{{ asset("local/public/images/japan8.svg") }}'>
	                            <h3 class="modal-title text-center"> Xác nhận đơn đặt hàng</h3>
	                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                                <span class="sr-only">Close</span>
	                            </button>
	                        </div>

	                        <!-- modal card form -->
	                            <div class="modal-body modal-tab-container">
	                            	<p> Giỏ hàng trống! Xin quý khách vui lòng thêm sản phẩm...</p>
	                        	</div>

	                            <div class="modal-footer">
	                                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
	                            </div>

                        	</form>
                        	<!-- /modal card form -->

	                    </div>
                	</div>
            	</div>
            	
            	@endif

            	<!-- /modal card confirm -->

			</div>
		</div>	
	</div>

@endsection