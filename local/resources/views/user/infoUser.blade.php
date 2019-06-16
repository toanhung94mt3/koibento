@extends('user.layout')

@section('title', 'THÔNG TIN TÀI KHOẢN')

@section('content')

    <div class="menu-sm">
        <div class="container">
            <ul class="nav">
                <li class="nav-item">
                    <a href="/koibento/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <span>
                        Thông tin tài khoản
                    </span>
                </li>
            </ul>
        </div>
    </div>

	<div class="container user_info" style="padding: 40px 0;">

		<h2 class="text-center text-uppercase"><img src='{{ asset("local/public/images/japan4.svg") }}' style="margin-bottom: 10px;">Thông tin tài khoản</h2>

		<div class="row">
			
			<div class="col-lg-4">

                <div class="all_info">
                    <h4 class="text-center">Thông tin cá nhân</h4>
                    <div class="all_info_in_left text-center">
                        <p>Tên tài khoản: {{$user->name}}</p>
                        <p>Email: {{$user->email}}</p>
                        <p>Mật khẩu: <a href="#" data-toggle="modal" data-target="#change-password" >Thay đổi mật khẩu</a></p>
                        <p>Quyền hạn: {{$user->level}}</p>
                        <p>Chi tiêu tại KOIBENTO: {{$user->total_payment}} VNĐ</p>
                        <p>Ưu đãi đang nhận: {{$user->get_deal}} %</p>  
                    </div>
                </div>

			</div>

			<div class="col-lg-8">

                <div class="all_info">
    				<h4 class="text-center">Sản phẩm ưa thích</h4>
    				<div class="all_info_in_right">

                    @if(count($products) == 0)

                        <p class="text-center" style="padding: 50px 0;"> Quý khách chưa thích bất kỳ sản phẩm nào !</p>

                    @else    

                        <table class="table table-striped table-bordered" style="margin: 0 !important;">
                            <thead>
                                <tr class="text-center">
                                    <th>Ảnh</th>
                                    <th>Sản phẩm</th> 
                                    <th>Khẩu phần</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($products as $product)
                                <?php $like_images = App\Product::find($product->id)->images; ?>
                                <tr class="tr_align">

                                    <td>
                                        @foreach($like_images as $like_image)
                                        <div class="like_item_image">
                                        <a href="#" data-toggle="modal" data-target="#modal-search-{{$product->id}}"><img src='{{ asset("local/public/images/$like_image->name") }}' width="100" height="auto"></a>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-search-{{$product->id}}"><span style="font-size: 12px;">{{$product->title}}</span></a>
                                    </td>
                                    <td>
                                        <span style="font-size: 12px;">{{$product->food_ingredients}}</span>
                                    </td>
                                    <td>
                                        <a class="un-like" href="/koibento/cart/remove-to-list/{{ $product->id }}"><i class="fas fa-heart-broken"></i></a>
                                    </td>
                                    
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    @endif
  
				    </div>
                </div>

			</div>		

		</div>

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="all_info">
                    <h4 class="text-center">Lịch sử đơn hàng</h4>
                    <div class="all_info_in_bottom text-center">

                    @if(count($orders) == 0)

                        <p style="padding: 50px 0;"> Quý khách chưa đặt bất kỳ đơn hàng nào !</p>

                    @else

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Thời gian đặt hàng</th> 
                                    <th>Sản phẩm</th>
                                    <th>Giá trị</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($orders as $order)
                                <tr>

                                    <td>KOI{{ $order->id }}GF#2D17</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <?php $products = App\Order::find($order->id)->products; ?>
                                        @foreach($products as $product)
                                            <span style="display: block"> {{$product->title}} </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($products as $product)
                                            <span id="" style="display: block"> {{$product->price}} VNĐ </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($products as $product )
                                            <span id="" style="display: block"> {{$product->pivot->quantity}} </span>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->total }} VNĐ</td>
                                    <td>@if($order->status == 0) {{'Đang chờ xử lý'}} @else {{'Hoàn thành'}} @endif </td>
                                    
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- modal change-password -->
	<div class="modal fade" id="change-password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><img src='{{ asset("local/public/images/japan7.svg") }}'> <em>ĐỔI MẬT KHẨU</em></h4>
                </div>
                <!-- modal card form -->
                <form id="change_password" enctype="multipart/form-data" action="javascript:void(0)" method="post">
                	
                	@method('PATCH')
                	@csrf

                    <div class="modal-body modal-tab-container">
                    	<p> Xin chú ý ghi nhớ của quý khách !</p>

                    	<div class="form-group row" style="margin-top: 1rem;">
                            <label class="col-sm-3 form-control-label text-xs-right" for="change_password_old"> Mật khẩu :</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control boxed" id="change_password_old" name="change_password_old" placeholder="Vui lòng nhập mật khẩu hiện tại của bạn."></div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label text-xs-right" for="change_password_new"> Mật khẩu mới :</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control boxed" id="change_password_new" name="change_password_new" placeholder="Vui lòng nhập mật khẩu mới của bạn ( từ 8 đến 16 ký tự )."></div>     
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label text-xs-right" for="change_password_new_again"> Nhập lại mật khẩu mới :</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control boxed" id="change_password_new_again" name="change_password_new_again" placeholder="Vui lòng nhập lại mật khẩu mới của bạn ( từ 8 đến 16 ký tự )."></div>     
                        </div>

                        <div class="alert alert-success d-none" id="msg_div">
			              	<span id="res_message"></span>
			    		</div> 
                    </div>

                    <div class="modal-footer">
                		<button type="submit" class="btn btn-success"> Xác Nhận </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>

            	</form>
            </div>
    	</div>
	</div>
	<!-- /modal change-password -->

@endsection