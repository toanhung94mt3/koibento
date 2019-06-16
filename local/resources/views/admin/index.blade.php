@extends('admin.layout')

@section('title', 'KOIBENTO ADMIN')

@section('content')

    <article class="content dashboard-page">
        <section class="section">
  
            <div class="row sameheight-container">
                <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
                    <div class="card sameheight-item stats" data-exclude="xs">
                        <div class="card-block">
                            <div class="title-block">
                                <h4 class="title"> Stats </h4>
                                <p class="title-description"> There are all Koibento's Stats
                                </p>
                            </div>
                            <div class="row row-sm stats-container">
                                <div class="col-12 col-sm-6 stat-col">
                                    <div class="stat-icon">
                                        <i class="fa fa-cutlery"></i>
                                    </div>
                                    <div class="stat">
                                        <div class="value"> {{ $products->count() }} </div>
                                        <div class="name"> Active products </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 stat-col">
                                    <div class="stat-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="stat">
                                        <div class="value"> {{$sold}} </div>
                                        <div class="name"> Products sold </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6  stat-col">
                                    <div class="stat-icon">
                                        <i class="fa fa-line-chart"></i>
                                    </div>
                                    <div class="stat">
                                        <div class="value"> {{$order->count()}} </div>
                                        <div class="name"> Active orders </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6  stat-col">
                                    <div class="stat-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="stat">
                                        <div class="value"> {{ $users->count() }} </div>
                                        <div class="name"> Total users </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6  stat-col">
                                    <div class="stat-icon">
                                        <i class="fa fa-list-alt"></i>
                                    </div>
                                    <div class="stat">
                                        <div class="value"> {{ $checked_order->count() }} </div>
                                        <div class="name"> Checked orders </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 stat-col">
                                    <div class="stat-icon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <div class="stat">
                                        <div class="value"> {{$total_income}} VNĐ</div>
                                        <div class="name"> Total income </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-12 col-md-6 col-xl-7 history-col">
                    <div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
                        <div class="card-header card-header-sm bordered">
                            <div class="header-block">
                                <h3 class="title">History</h3>
                            </div>
                            <ul class="nav nav-tabs pull-right" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#visits" role="tab" data-toggle="tab">Sales chart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#downloads" role="tab" data-toggle="tab">User registration</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active fade show" id="visits">
                                    <p class="title-description"> Number of products sold last 30 days </p>
                                    <div id="dashboard-visits-chart"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="downloads">
                                    <p class="title-description"> Number of users last 30 days </p>
                                    <div id="dashboard-downloads-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-8">
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                        <div class="card-header bordered" >
                            <div class="header-block">
                                <h3 class="title"> Top products </h3>
                                <a href="/koibento/admin/products/creator
                                " class="btn btn-primary btn-sm"> Add new </a>
                            </div>

                            <div style="margin-left: 215px;">

                                {{ $products5->links() }}

                            </div>
                                
                        </div>
                        <ul class="item-list striped">

                            <li class="item item-list-header" style="padding: 10px 0;">
                                <div class="item-row">
                                    <div class="item-col item-col-header fixed item-col-img xs"></div>
                                    <div class="item-col item-col-header item-col-title">
                                        <div>
                                            <span>Title</span>
                                        </div>
                                    </div>
                                    <div class="item-col item-col-header item-col-sales">
                                        <div>
                                            <span>Category</span>
                                        </div>
                                    </div>
                                    <div class="item-col item-col-header item-col-sales">
                                        <div class="no-overflow">
                                            <span>Price</span>
                                        </div>
                                    </div>
                                    <div class="item-col item-col-header item-col-sold">
                                        <div>
                                            <span>Sold</span>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @foreach($products5 as $product)
                         
                            <li class="item">
                                <div class="item-row">
                                    <div class="item-col fixed item-col-img xs">

                                        <a href="/koibento/admin/products/{{$product->id}}/editor">

                                            <?php

                                                $images = App\Product::find($product->id)->images;
                                                foreach ($images as $image) {
                                                    ?>
                                                    
                                                    <div class="item-img xs rounded" style="overflow: hidden">
                                                    <img src=' {{ asset("local/public/images/$image->name") }}' width="50" height="auto">
                                                    </div>

                                                    <?php
                                                }
                                                
                                            ?>
                                                   
                                        </a>
                                    </div>
                                    <div class="item-col item-col-title no-overflow">
                                        <div>
                                            <a href="/koibento/admin/products/{{$product->id}}/editor" style="text-decoration: none !important;">
                                                <h4 class="item-title no-wrap" title="{{$product->description}}"> {{ $product->title }} </h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-col item-col-sales">
                                        <div class="item-heading">Sales</div>
                                        <div>
                                            <?php
                                                $tl=null;
                                                if($product->category_id == 1)
                                                {
                                                    $tl = 'BigBento';
                                                }
                                                elseif ($product->category_id == 2) {
                                                    $tl = 'MiniBento';
                                                }else $tl = 'Sushi';
                                                echo $tl;                 
                                            ?>         
                                        </div>
                                    </div>
                                    <div class="item-col item-col-stats">
                                        <div class="item-heading">Stats</div>
                                        <div>
                                            <span>{{$product->price}} VNĐ</span>
                                        </div>
                                    </div>
                                    <div class="item-col item-col-sold">
                                        <div class="item-heading">Published</div>
                                        <div> {{$product->sold}} </div>
                                    </div>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                    <!-- <div style="text-align:center; text-decoration: none !important;">
                    
                    </div> -->

                </div>
                <div class="col-xl-4">
                    <div class="card sameheight-item sales-breakdown" data-exclude="xs,sm,lg">
                        <div class="card-header">
                            <div class="header-block">
                                <h3 class="title"> Sales breakdown </h3>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="dashboard-sales-breakdown-chart" id="dashboard-sales-breakdown-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>

@endsection