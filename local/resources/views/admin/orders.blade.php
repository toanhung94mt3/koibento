@extends('admin.layout')

@section('title', 'ACTIVE ORDERS')

@section('content')

    <article class="content responsive-tables-page">
        <div class="title-search-block">

            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"> Active orders list 
                            <a href="/koibento/admin/orders/history" class="btn btn-pill-left btn-primary btn-sm"> History </a>
                            <a href="/koibento/admin/income/table" class="btn btn-pill-right btn-info btn-sm" style="color:#fff;">$ Income </a>
                        </h3>
                        <p class="title-description"> List of all active order </p>
                    </div>
                </div>
            </div>
            
            <div class="card items" style="padding: 15px 5px 5px 5px; border-radius: 5px;">
                <h3 class="title" align="center"> Laravel 5.8 - DATA TABLE - Check complete or Remove Order </h3>

                <!-- ckeck complete message -->
                @if ($message = Session::get('check_success'))
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                </div> 
                @endif
                <!-- /ckeck complete message -->

                <!-- remove message -->
                @if ($message = Session::get('remove_success'))
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                </div> 
                @endif 
                <!-- /remove message -->
               

                <!-- main table -->
                <table id="orders_list" class="table table-striped table-bordered" style="">
                    <thead>
                        <tr>
                            <th style="width:3%;">ID</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th style="width:7%;">Amount</th>
                            <th style="width:5%;">Quantity</th>
                            <th>Total</th>
                            <th>Note</th>
                            <th>Delivery Address</th>
                            <th>Delivery time</th> 
                            <th>Phone number</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)

                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                @if($order->user_id == 0){{'Guest'}}
                                @endif
                                @foreach($users as $user)
                                    @if($order->user_id == $user->id)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
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
                            <td>{{ $order->note }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->delivery_time }}</td>
                            <td>{{ $order->phone }}</td>
                            
                            <td><a class="edit btn btn-info btn-sm d-block" style="color:#fff" href="/koibento/admin/export/pdf/{{$order->id}}"><<i class="fa fa-file-pdf-o"></i> Export .PDF</a>
                                <button id="" class="edit btn btn-primary btn-sm d-block" data-toggle="modal" data-target="#confirm-ckeck-{{$order->id}}">
                                    <i class="fa fa-check-square-o"></i> Check
                                </button>
                                <button class="btn btn-secondary btn-sm d-block" data-toggle="modal" data-target="#confirm-delete-{{$order->id}}">
                                    <i class="fa fa-trash-o "></i> Remove
                                </button>
                            </td>
                        </tr>

                        <!-- modal remove -->
                        <div class="modal fade" id="confirm-delete-{{$order->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <i class="fa fa-warning"></i> Delete order - ID {{$order->id}} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure want to REMOVE this order?</p>
                                    </div>
                                    <div class="modal-footer">

                                        <form method ="POST" action="/koibento/admin/orders/active/{{$order->id}}">

                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /modal remove -->

                        <!-- modal check complete-->
                        <div class="modal fade" id="confirm-ckeck-{{$order->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <i class="fa fa-check-square-o"></i> Check order - ID {{$order->id}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure want to Check - complete this order?</p>
                                    </div>
                                    <div class="modal-footer">

                                        <form method ="POST" action="/koibento/admin/orders/active/{{$order->id}}">

                                            @csrf

                                            @foreach($users as $user)

                                                @if($order->user_id == $user->id)
                                                <input type ="hidden" name="customer" value="{{ $user->name }}">
                                                <input type ="hidden" name="total" value="{{ $order->total }}">
                                                <input type ="hidden" name="get_deal" value="{{ $user->get_deal }}">
                                                @endif

                                                @if($order->user_id == 0)
                                                <input type ="hidden" name="customer" value="Guest">
                                                <input type ="hidden" name="total" value="{{ $order->total }}">
                                                <input type ="hidden" name="get_deal" value="0">
                                                @endif

                                            @endforeach
                                            
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /modal check complete-->

                        @endforeach

                    </tbody>                
                </table>
                <!-- /main table -->

            </div>

        </div>

    </article>

@endsection