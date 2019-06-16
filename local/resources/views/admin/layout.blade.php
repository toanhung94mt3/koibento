<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
        <!-- Theme initialization -->
        <link rel="stylesheet" href="{{ asset('css/app-red.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    </head>
    <style>
        .fa-check-square-o:hover{
            color: #e6c515;
        }
        
        .table-id{
            color: #999;
            font-size: 0.8rem;
            font-weight: 700 !important;
        }
        .item-row .item-col-sold{
        text-align: center;
        margin-left: 0 !important;
        margin-right: auto;
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -webkit-box-flex: 9;
        -ms-flex-positive: 9;
        flex-grow: 2;
        }
        .pagination{
            display: flex !important;
            margin: 0 !important;
            flex-direction: row;
        }

        a{
            text-decoration: none !important;
        }
        .modal-overlay-img{
            width:100px;
            height:75px;
            display: inline-block;
            overflow: hidden;
        }
        .modal-overlay-btn{
            display: flex;
            flex-direction: row-reverse;
            width: 100px;
            height: 75px;
            background-color:;
            margin-top: -81px;
        }
    </style>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-search">
                        <form action="/koibento/admin/products/search" method="post" role="search" style="display:flex; flex-direction:row">

                            @csrf

                            <div class="input-container">
                                <i class="fa fa-search"></i> 

                                    <input type="text" id="txtSearchProduct" name="txtSearchProduct" placeholder="Anything about product..." required>

                                    <button type="submit" id="btnSearchProduct" class="btn btn-secondary btn-sm"> Search </button>

                                <div class="underline"></div>
                            </div>
                        </form>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">

                            <li class="notifications new">
                                <a href="" data-toggle="dropdown" id="click_event">
                                    <i class="fa fa-bell-o"></i>
                                    <sup>
                                        <span class="counter" id="responsecontainer"><?php $notifications = DB::table('notifications')->where('status', '=', 0)->orderBy('created_at', 'ASC')->get();?>{{count($notifications)}} </span>
                                    </sup>
                                </a>
                                <div class="dropdown-menu notifications-dropdown-menu" id="responseList">
                                    <ul class="notifications-container">
                                        <li>
                                            <!--AJAX data-->
                                        </li>
                                    </ul>
                                </div>
                                <input id="input_hd" type="hidden" name="input_hd" value="">
                            </li>

                            <li class="profile dropdown">

                                @if(Auth::guard('admin')->check())

                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="name">
                                        <?php
                                            $id = Auth::guard('admin')->id();
                                            $admin = App\User::find($id);
                                            echo $admin->name;
                                        ?>                                                                
                                    </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="/koibento/admin/users">
                                        <i class="fa fa-user icon"></i> Profile </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-bell icon"></i> Notifications </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/koibento/admin/logout">
                                        <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>

                                @endif

                            </li>
                        </ul>
                    </div>

                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                                    <span class="l l1"></span>
                                    <span class="l l2"></span>
                                    <span class="l l3"></span>
                                    <span class="l l4"></span>
                                    <span class="l l5"></span>
                                </div> Koibento Admin </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li class="active">
                                    <a href="/koibento/admin/index">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>

                                 <li>
                                    <a href="/koibento/admin/users">
                                        <i class="fa fa-users"></i>Users Profile
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i class="fa fa-file-text-o"></i><span style="margin-left:-2px"> Orders Manager</span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="/koibento/admin/orders/active"><i class="fa fa-rocket"></i> Active Order </a>
                                        </li>
                                        <li>
                                            <a href="/koibento/admin/orders/history"><i class="fa fa-list-alt"></i> History </a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="">
                                        <i class="fa fa-th-large"></i> Products Manager
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="/koibento/admin/products"><i class="fa fa-list-alt"></i> Products List </a>
                                        </li>
                                        <li>
                                            <a href="/koibento/admin/products/creator"><i class="fa fa-plus"></i> Products Creator </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                 <li>
                                    <a href="" style="margin-left:-2px">
                                        <i class="fa fa-image"></i> <span style="margin-left:-1px">Images Manager</span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="/koibento/admin/image"><i class="fa fa-list-alt"></i> Image library </a>
                                        </li>
                                        <li>
                                            <a href="/koibento/admin/image/upload"><i class="fa fa-upload"></i> Add a new image </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="">
                                        <i class="fa fa-dollar"></i><span style="margin-left:3px">Income</span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="/koibento/admin/income/table"><i class="fa fa-file-excel-o"></i><span style="margin-left:2px"> Table </span> </a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fa fa-pie-chart"></i> Pie chart ( comming soon ! ) </a>
                                        </li>
                                    </ul>
                                </li>     
                               
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="sidebar-menu metismenu" id="customize-menu">
                            <li>
                                <ul>
                                    <li class="customize">
                                        <div class="customize-item">
                                            <div class="row customize-header">
                                                <div class="col-4"> </div>
                                                <div class="col-4">
                                                    <label class="title">fixed</label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="title">static</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Sidebar:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Header:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Footer:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="">
                                    <i class="fa fa-cog"></i> Customize </a>
                            </li>
                        </ul>
                    </footer>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>


               	@yield('content')


                <footer class="footer">
                    <div class="footer-block buttons">

                    </div>
                    <div class="footer-block author">
                        <ul>
                            <li> Created by
                                <a href="">CODE-K43 HKP leader</a>
                            </li>
                            <li>
                                <a href="">REACH-center</a>
                            </li>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#users_list').DataTable();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#orders_list').DataTable();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#history').DataTable();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#income').DataTable();
            });
        </script>

        <!--auto load-->
        <script type="text/javascript">
            $(document).ready(function () {

                function load() {
                    $.ajax({ 
                        type: "GET",
                        url: "http://localhost/koibento/admin/load",
                        dataType: "json",               
                        success: function (response) {
                            $("#responsecontainer").html(response.countmsg);
                            $("#responseList").html(response.message);
                            setTimeout(load, 15000)
                        }
                    });
                }

                load();
               
            });
        </script>
        <!--/auto load-->

        <!--message dismiss-->
        <!--  <script type="text/javascript">
            $(document).ready(function () {

                $("#click_event").on('click',function(){

                    $.ajax({ 
                        type: "GET",
                        url: "http://localhost/koibento/admin/read",
                        dataType: "json",               
                        success: function (response) {
                           /* $("#responsecontainer").html(response.countmsg);
                            $("#responseList").html(response.message);
                            setTimeout(load, 15000)*/
                        }
                    });
                    
                });
               
            });
        </script> -->
        <!--/message dismiss-->

    </body>
</html>