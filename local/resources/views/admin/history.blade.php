@extends('admin.layout')

@section('title', 'CHECKED ORDERS')

@section('content')

	<article class="content responsive-tables-page">
        <div class="title-search-block">

            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"> Checked orders list </h3>
                        <p class="title-description"> List of all checked order </p>
                    </div>
                </div>
            </div>
            
            <div class="card items" style="padding: 15px 5px 5px 5px; border-radius: 5px;">
                <h3 class="title" align="center"> Laravel 5.8 - DATA TABLE - Delete all history </h3>

                <!-- delete message -->
                @if ($message = Session::get('delete_success'))
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                </div> 
                @endif
                <!-- /delete message -->

                <div align="right">
                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#confirm-delete-all">
                        <i class="fa fa-trash-o "></i> Delete all History
                    </button> 
                </div>
                

                <!-- main table -->
                <table id="history" class="table table-striped table-bordered" style="">
                    <thead>
                        <tr>
                            <th style="width:3%;">ID</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th style="width:10%;">Amount</th>
                            <th style="width:5%;">Quantity</th>
                            <th>Total</th>
                            <th>Note</th>
                            <th>Delivery Address</th>
                            <th>Delivery time</th> 
                            <th>Phone number</th>
                            <th>Check time</th> 
                            <th>Admin check</th>
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
                            <td>{{ $order->updated_at }}</td>
                            <td>{{ $order->admin_check }}</td>
                        </tr>

                        @endforeach

                    </tbody>                
                </table>
                <!-- /main table -->

                <div class="modal fade" id="confirm-delete-all">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-warning"></i> Delete all - History </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to DELETE this record?</p>
                            </div>
                            <div class="modal-footer">

                                <form method ="POST" action="/koibento/admin/orders/history">

                                    @method('DELETE')
                                    @csrf

                                    <button type="submit" class="btn btn-primary">Yes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </article>

@endsection