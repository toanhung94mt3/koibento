@extends('admin.layout')

@section('title', 'IMAGE UPLOAD')

@section('content')
    <article class="content item-editor-page">
        <div class="title-block">
            <h3 class="title">Upload your image :</h3>
        </div>

        <div class="panel panel-primary">

            <div class="panel-body">

                <form action="/koibento/admin/image/upload" method="POST" enctype="multipart/form-data">

                @csrf

                    <div class="row" style="margin-bottom: 1rem;">

                        <div class="col-md-8">

                            <input type="file" name="image" class="form-control">

                        </div>

                        <div class="col-md-4" style="display: flex; align-items: : center;">

                            <button type="submit" class="btn btn-pill-left btn-info" style = "margin:0 15px 0 0;  color:#fff !important;">Upload</button>
                            <a href="/koibento/admin/image" class="btn btn-pill-right btn-primary" style = "margin:0; line-height: 2.1;"> Your Album </a>

                        </div>

                    </div>

                </form>

                @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{{ $message }}</strong>

                </div>

                <img src="{{ Session::get('image') }}" width="576" height="auto" style="display: block; margin: 0 auto;">

                @endif

                @if (count($errors) > 0)

                <div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

            </div>

        </div>

    </article>

@endsection