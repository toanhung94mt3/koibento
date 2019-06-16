@extends('admin.layout')

@section('title', 'PRODUCTS EDITOR')

@section('content')
    
    <article class="content item-editor-page">

        <div class="title-block">
            <h3 class="title"> Edit product
                <a href="/koibento/admin/products" class="btn btn-primary btn-sm rounded-s"> Products list </a>
                <span class="sparkline bar" data-type="bar"></span>
            </h3>
        </div>

        @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

            </div>

        @endif

        @if($errors->any())

            <div style="color:#FF6161">
                
                 <ul>

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>
             
            </div>

        @endif

        <form action="/koibento/admin/products/{{ $product->id }}/editor" method="POST" name="edit">

            @method('PATCH')

            @csrf

            <div class="card card-block">

                <div class="form-group row">
                    <div class="col-sm-2" style="display:flex; align-items: center">
                        <label class="form-control-label text-xs-right"> Images: </label>
                    </div>          
                    <div class="col-sm-10">
                        <div class="images-container" style="display: inline-block;">
                            <a href="#" data-toggle="modal" data-target="#modal-media-swap" >

                                @foreach($product->images as $image)

                                <div class="image" style="overflow: hidden; width: 200px; height:150px; display: inline-block;" >
                                    <img src='{{ asset("local/public/images/$image->name") }}' width="250" height="auto">
                                </div>

                                @endforeach

                                <div style="width: 210px; height:160px; overflow:hidden; display:inline-block; position:relative; z-index:1; right:205px; top:5px;">
                                    <img src="{{ Session::get('img') }}" width="250" height="auto">
                                </div>
                                
                            </a>
                            <input type="hidden" value="{{ Session::get('imgId') }}" name="image">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="title"> Title: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control boxed" name="title" value="{{$product->title}}"></div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="category_id"> Category: </label>
                    <div class="col-sm-10">
                        <select class="c-select form-control boxed" name="category_id">
                            <option disabled>Select Category</option>
                            <option value="1" <?php if($product->category_id==1){ echo 'selected';} ?>> BIG BENTO </option>
                            <option value="2" <?php if($product->category_id==2){ echo 'selected';} ?>> MINI BENTO </option>
                            <option value="3" <?php if($product->category_id==3){ echo 'selected';} ?>> SUSHI </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="food_ingredients"> Food ingredients: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control boxed" name="food_ingredients" value="{{$product->food_ingredients}}" placeholder="Please enter ingredients of product"></div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" for="description"> Decription: </label>
                    <div class="col-sm-10">
                        <textarea class="form-control boxed" name="description" value="" placeholder="Please enter decription of product"> {{$product->description}} </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right" f0r="price"> Price: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control boxed" value="{{$product->price}}" name="price" placeholder="Please enter price of product (ex: 45.000 vnđ = 45)"></div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-sm-offset-2" style="display: flex; justify-content: space-between;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirm-delete-product">
                            <i class="fa fa-trash-o "></i> Delete 
                        </button>
                    </div>
                </div>

            </div>
        </form>


        <!-- .modal-dialog -->
        <div class="modal fade" id="modal-media-swap">
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

                            @foreach($imgs as $img)

                            <div style="margin: 0 5px 5px 0;">
                                <div class="modal-overlay-img">
                                    <img src='{{asset("local/public/images/$img->name")}}' width="125" height="auto">
                                </div>
                                <div class="modal-overlay-btn" title="{{$img->name}}" >
                                    <form action="/koibento/admin/products/creator/get-id-swap/{{$img->id}}" method="POST">
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


        <!-- .modal-dialog -->
        <div class="modal fade" id="confirm-delete-product">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fa fa-warning"></i> Alert</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to DELETE this product?</p>
                    </div>
                    <div class="modal-footer">

                        <form method ="POST" action="/koibento/admin/products/{{$product->id}}">

                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                        </form>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </article>

@endsection