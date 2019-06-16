@extends('admin.layout')

@section('title', 'USERS PROFILE')

@section('content')

	<article class="content responsive-tables-page">
        <div class="title-search-block">

            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"> Users list </h3>
                        <p class="title-description"> List of all user </p>
                    </div>
                </div>
            </div>
            
            <div class="card item" style="padding: 15px 5px 5px 5px; border-radius: 5px;">
                <h3 class="title" align="center"> Laravel 5.8 - DATA TABLE - Create, Edit, Delete User And Export Data</h3>

                <div align="right" style="display: flex; justify-content: space-between;">
                    <a class="btn btn-info btn-sm" style="color: #fff;" href="/koibento/admin/export/users"> <i class="fa fa-file-excel-o"></i> Export User Data</a>
                    <button type="button" name="create_record" id="create_user" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-user">
                        <i class="fa fa-user-plus"></i> Add new user 
                    </button>
                </div>

                <!-- create message -->
                @if ($message = Session::get('create_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <!-- /create message -->

                <!-- edit message -->
                @if ($message = Session::get('edit_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <!-- /edit message -->

                <!-- delete message -->
                @if ($message = Session::get('delete_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <!-- /delete message -->

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

                <!-- main table -->
                <table id="users_list" class="table table-striped table-bordered" style="">
                    <thead>
                        <tr>
                            <th style="width:3%;">ID</th>
                            <th>User Name</th>
                            <th>Level</th>
                            <th style="width:5%;">Total Payment</th>
                            <th style="width:5%;">Get deal(%)</th>
                            <th>Email</th>
                            <th style="width:8%;">Phone Number</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if($user->level == 'Superadmin')
                                <span class="text-danger">{{ $user->level }}<span>
                                @else {{ $user->level }} @endif
                            </td>
                            <td>{{ $user->total_payment }} VNĐ</td>
                            <td>{{ $user->get_deal }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <button id="" class="edit btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-user-{{$user->id}}">
                                    <i class="fa fa-pencil"></i> Edit
                                </button>
                                @if($user->level != 'Superadmin')
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#confirm-delete-{{$user->id}}">
                                    <i class="fa fa-trash-o "></i> Delede
                                </button>
                                @endif
                            </td>
                        </tr>

                        <!-- modal edit -->
                        <div class="modal fade" id="modal-edit-user-{{$user->id}}" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit user - {{$user->name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </div>

                                    <!-- modal edit form-->
                                    <form enctype="multipart/form-data" action="/koibento/admin/users/{{$user->id}}/edit" method="post" name="">

                                        @method('PATCH')

                                        <div class="modal-body modal-tab-container">
                                            <div class="tab-content modal-tab-content" style="padding: 15px 50px;">

                                            @csrf

                                                <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label text-xs-right" for="name"> User name </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control boxed" name="name" value="{{$user->name}}" placeholder="Name must be at least 8-16 characters."></div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label text-xs-right" for="password"> Password </label>
                                                    <div class="col-sm-9">
                                                        @if($user->level == 'Superadmin')
                                                        <input type="text" class="form-control boxed" name="" value="" disabled placeholder="Password must be at least 8-16 characters."></div>
                                                        @else
                                                        <input type="text" class="form-control boxed" name="password" value="" placeholder="Password must be at least 8-16 characters."></div>
                                                        @endif
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label text-xs-right" for="level"> Level </label>
                                                    <div class="col-sm-9">
                                                        @if($user->level == 'Superadmin')
                                                        <select class="c-select form-control boxed" disabled>
                                                            <option value="Superadmin" selected> Super Admin</option>
                                                            <input type="hidden" name="level" value="Superadmin">
                                                        </select>
                                                        @else
                                                        <select class="c-select form-control boxed" name="level">
                                                            <option value="admin" <?php if($user->level == 'admin'){echo 'selected';} ?> >Admin</option>
                                                            <option value="user" <?php if($user->level != 'admin'){echo 'selected';} ?> >User</option>
                                                        </select>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label text-xs-right" for="get_deal"> Deal </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control boxed" name="get_deal" value="{{$user->get_deal}}" placeholder="Please enter user's deal(%) (ex: 5 = 5% order's price)"></div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label text-xs-right" for="email"> Email </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control boxed" name="email" value="{{$user->email}}" placeholder="Please enter email Address" disabled></div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label text-xs-right" for="phone"> Phone number </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control boxed" name="phone" value="{{$user->phone}}" placeholder="Please enter phone number">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                        </div>
                                    </form>
                                    <!-- /modal edit form -->

                                </div>
                            </div>
                        </div>
                        <!-- /modal edit -->

                        <!-- modal delete-->
                        <div class="modal fade" id="confirm-delete-{{$user->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <i class="fa fa-warning"></i> Delete - {{$user->name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure want to DELETE this user?</p>
                                    </div>
                                    <div class="modal-footer">

                                        <form method ="POST" action="/koibento/admin/users/{{$user->id}}">

                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /modal delete-->

                        @endforeach

                    </tbody>                
                </table>
                <!-- /main table -->

            </div>

            <!-- modal create -->
            <div class="modal fade" id="modal-add-user">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add new user</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>

                        <!-- modal create form-->
                        <form enctype="multipart/form-data" action="/koibento/admin/users/create" method="post" name="">

                            <div class="modal-body modal-tab-container">
                                <div class="tab-content modal-tab-content" style="padding: 15px 50px;">

                                @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="name"> User name </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control boxed" name="name" placeholder="Name must be at least 8-16 characters."></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="password"> Password </label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control boxed" name="password" placeholder="Password must be at least 8-16 characters."></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="password"> Re-enter password </label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control boxed" name="passwordAgain" placeholder="Password must be at least 8-16 characters."></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="level"> Level </label>
                                        <div class="col-sm-9">
                                            <select class="c-select form-control boxed" name="level">
                                                <option selected disabled>Select Level</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="get_deal"> Deal </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control boxed" name="get_deal" placeholder="Please enter user's deal(%) (ex: 5 = 5% order's price)"></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="email"> Email </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control boxed" name="email" placeholder="Please enter email Address"></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label text-xs-right" for="phone"> Phone number </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control boxed" name="phone" placeholder="Please enter phone number">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                            </div>
                        </form>
                        <!-- /modal create form -->

                    </div>
                </div>
            </div>
            <!-- /modal create -->

    </article>

@endsection