@extends('admin.layout')

@section('title', 'SEARCH')

@section('content')

    <article class="content items-list-page">
        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"> Search products
                            <a href="/koibento/admin/products/creator" class="btn btn-primary btn-sm rounded-s"> Add New </a>
                        </h3>
                        <p class="title-description"> {{ $products->count() }} products was found </p>
                    </div>
                </div>
            </div>
            <div class="items-search">
            </div>
        </div>
        <div class="card items">
            <ul class="item-list striped">
                <li class="item item-list-header">
                    <div class="item-row">
                        <div class="item-col fixed item-col-check">
                            <label class="item-check" id="select-all-items">
                                <input type="checkbox" class="checkbox">
                                <span></span>
                            </label>
                        </div>
                        <div class="item-col item-col-header fixed item-col-img md">
                            <div>
                                <span>Product</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header item-col-author">
                            <div class="no-overflow">
                                <span>Title</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header item-col-sales">
                            <div>
                                <span>Category</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header item-col-title">
                            <div>
                                <span>Decription</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow">
                                <span>Price</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header item-col-category">
                            <div class="no-overflow">
                                <span>Sold</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div>
                                <span>Update at</span>
                            </div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                    </div>
                </li>

                @foreach($products as $product)

                <li class="item">
                    <div class="item-row">
                        <div class="item-col fixed item-col-check">
                            <label class="item-check" id="select-all-items">
                                <input type="checkbox" class="checkbox">
                                <span></span>
                            </label>
                        </div>
                        <div class="item-col fixed item-col-img md">
                            <a href="/koibento/admin/products/{{$product->id}}/editor">
                                <div class="item-img rounded" style="overflow: hidden;">
                                    <?php
                                        $image = '';
                                        $image = DB::table('images')
                                        ->select('name')
                                        ->where('product_id','=', $product->id)
                                        ->get();
                                        $img = $image[0]->name;
                                    ?>
                                    <img src='{{ asset("local/public/images/$img") }}' width="90" height="auto">
                                </div>
                            </a>
                        </div>
                        <div class="item-col item-col-author">
                            <div class="item-heading">Author</div>
                            <div class="no-overflow" >
                                <a href="/koibento/admin/products/{{$product->id}}/editor" style="text-decoration: none;">{{$product->title}}</a>
                            </div>
                        </div>
                        <div class="item-col item-col-sales">
                            <div class="item-heading">Sales</div>
                            <div>
                            <?php
                                $tl=null;
                                if($product->category_id == 1)
                                {
                                    $tl = 'BIG BENTO';
                                }
                                elseif ($product->category_id == 2) {
                                    $tl = 'MINI BENTO';
                                }else $tl = 'SUSHI';
                                echo $tl;                 
                            ?>
                            </div>
                        </div>
                        <div class="item-col fixed pull-left item-col-title">
                            <div class="item-heading">Name</div>
                            <div>
                                <p>
                                    {{$product->description}}
                                </p>
                            </div>
                        </div>
                        <div class="item-col item-col-category no-overflow">
                            <div class="item-heading">Category</div>
                            <div class="no-overflow">
                                <p>{{$product->price}} VNĐ</p>
                            </div>
                        </div>
                        <div class="item-col item-col-category no-overflow">
                            <div class="item-heading">Category</div>
                            <div class="no-overflow">
                                <p>{{$product->sold}}</p>
                            </div>
                        </div>
                        <div class="item-col item-col-date">
                            <div class="item-heading">Published</div>
                            <div class="no-overflow"> {{$product->created_at}} </div>
                        </div>
                        <div class="item-col fixed item-col-actions-dropdown">
                            <div class="item-actions-dropdown">
                                <a class="item-actions-toggle-btn">
                                    <span class="inactive">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    <span class="active">
                                        <i class="fa fa-chevron-circle-right"></i>
                                    </span>
                                </a>
                                <div class="item-actions-block">
                                    <ul class="item-actions-list">

                                        <li>
                                            <a class="remove" href="/koibento/admin/products/{{$product->id}}/editor">
                                                <i class="fa fa-trash-o "></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="edit" href="/koibento/admin/products/{{$product->id}}/editor">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                @endforeach

            </ul>
            
        </div>
        
    </article>

@endsection