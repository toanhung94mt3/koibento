@extends('admin.layout')

@section('title', 'INCOME TABLE')

@section('content')

	<article class="content responsive-tables-page">
        <div class="title-search-block">

            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"> Income Table 
                            <a href="/koibento/admin/orders/history" class="btn btn-primary btn-sm"> History </a>
                        </h3>
                        <p class="title-description"> All revenue - KOIBENTO's website</p>
                    </div>
                </div>
            </div>
            
            <div class="card items" style="padding: 15px 5px 5px 5px; border-radius: 5px;">
                <h3 class="title" align="center"> Laravel 5.8 - DATA TABLE - Export Datatable to Excel file </h3>

                <div align="right" style="display: flex; justify-content: space-between;">
                    <a class="btn btn-info btn-sm" style="color: #fff;" href="/koibento/admin/export/transactions"> <i class="fa fa-file-excel-o"></i> Export Transaction Data</a>
                </div>

                <!-- delete message -->
                @if ($message = Session::get('delete_success'))
                <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                </div> 
                @endif
                <!-- /delete message -->
               
                <!-- main table -->
                <table id="income" class="table table-striped table-bordered" style="">
                    <thead>
                        <tr>
                            <th style="width:3%;">ID</th>
                            <th>Customer</th>
                            <th>Date & Time</th>
                            <th>Total Amount</th>
                            <th style="width:10%;">Deal (%)</th>
                            <th>Income</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($transactions as $transaction)

                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->customer }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->total }} VNĐ</td>
                            <td>{{ $transaction->deal }}</td>
                            <td>{{ $transaction->income }} VNĐ</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#confirm-delete-{{$transaction->id}}">
                                    <i class="fa fa-trash-o "></i> Delete record
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="confirm-delete-{{$transaction->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <i class="fa fa-warning"></i> Delete record - ID {{$transaction->id}} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure want to DELETE this record?</p>
                                    </div>
                                    <div class="modal-footer">

                                        <form method ="POST" action="/koibento/admin/income/table/{{$transaction->id}}">

                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <p class="title">$ Total income : {{ $total_income }} VNĐ</p>
                        </tr>  
                    </tfoot>                
                </table>
                <!-- /main table -->

            </div>

        </div>

    </article>

@endsection