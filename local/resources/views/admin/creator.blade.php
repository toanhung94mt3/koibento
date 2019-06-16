@extends('admin.layout')

@section('title', 'PRODUCTS CREATOR')

@section('content')

    <article class="content item-editor-page">

        <div class="title-block">
            <h3 class="title"> Add a new product
                <span class="sparkline bar" data-type="bar"></span>
            </h3>
        </div>

        @if($errors->any())

            <div style="color:#FF6161">
                
                <ul>

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>
             
            </div>

        @endif

        <form enctype="multipart/form-data" action="/koibento/admin/products/creator" method="POST" name="creator">

            @csrf

            <div class="card card-block">

                <div class="form-group row">
                    <div class="col-sm-2" style="display:flex; align-items: center">
                        <label class="form-control-label text-xs-right" for="image"> Images: </label> 
                    </div>
                    
                    <div class="col-sm-10">
                        <a href="#" class="add-image" data-toggle="modal" data-target="#modal-media-add">
                            <div class="image-container new" style=" display: inline-block;">
                                <div class="image" style="  width: 200px;
                                                            height:150px;
                                                            display:flex;
                                                            justify-content:center;
                                                            align-items:center;
                                                            border:1px solid #FF6161;">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div style="width: 200px; height:150px; overflow: hidden; margin-top: -150px;">
                                    <img src="{{ Session::get('image') }}" width="250" height="auto">
                                </div>
                            </div>  
                        </a>
                        <input type="hidden" value="{{ Session::get('imageId') }}" name="image">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="title"> Title: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control boxed" name="title" placeholder="Please enter name of product"></div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="category_id"> Category: </label>
                    <div class="col-sm-10">
                        <select class="c-select form-control boxed" name="category_id">
                            <option selected disabled>Select Category</option>
                            <option value="1">BIG BENTO</option>
                            <option value="2">MINI BENTO</option>
                            <option value="3">SUSHI</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="food_ingredients"> Food ingredients: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control boxed" name="food_ingredients" placeholder="Please enter ingredients of product"></div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="description"> Decription: </label>
                    <div class="col-sm-10">
                        <textarea class="form-control boxed" name="description" placeholder="Please enter decription of product"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="price"> Price: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control boxed" name="price" placeholder="Please enter price of product (ex: 45.000 vnđ = 45)">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary"> Create product </button>
                    </div>
                </div>

            </div>

        </form>

        <div class="modal fade" id="modal-media-add">
            <!-- .modal-dialog -->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Media Library</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body modal-tab-container">
                        <div class="tab-content modal-tab-content" style="display: flex; padding: 10px;">

                            @foreach($images as $image)

                            <div style="margin: 0 5px 5px 0;">
                                <div class="modal-overlay-img" >
                                    <img src='{{asset("local/public/images/$image->name")}}' width="125" height="auto">
                                </div>
                                <div class="modal-overlay-btn" title="{{$image->name}}" >
                                    <form action="/koibento/admin/products/creator/get-id/{{$image->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></button>
                                    </form>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </article>

@endsection