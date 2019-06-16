@extends('admin.layout')

@section('title', 'IMAGE STORE')

@section('content')
	<article class="content item-editor-page">
		<div class="title-block">
	        <h3 class="title">Library
	        	<a href="/koibento/admin/image/upload" class="btn btn-primary btn-sm rounded-s"> Add New Image + </a>
	    	</h3>
	    	<p class="title-description"> List of all images - sorted by lastest update</p>
	    </div>
 	 	
 	 	<!-- slide message -->
        @if ($message = Session::get('slide_success'))
        <div class="container row">
	        <div class="alert alert-success alert-block" style="width:100%;">
	                <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
	                <strong>{{ $message }}</strong>
	        </div>
	    </div>
        @endif
        <!-- /slide message -->

        <!-- delete message -->
        @if ($message = Session::get('delete_success'))
        <div class="container row">
	        <div class="alert alert-success alert-block" style="width:100%;">
	                <button type="button" class="close" data-dismiss="alert" style="color: #fff">×</button>
	                <strong>{{ $message }}</strong>
	        </div>
	    </div>
        @endif
        <!-- /slide message -->

		<div class="container row" style="margin-top: 15px; display: flex; flex-wrap: wrap;">

			@foreach($images as $image)

				<div class="" style="margin: 10px 20px 10px 0; overflow: hidden;">
			        <div class="image" style="width:230px; height:150px; overflow: hidden; border-radius: 5px;">
			            <img src='{{ asset("local/public/images/$image->name") }}' width="250" height="auto">
			        </div>
			        <div style="width:200px; box-sizing: border-box;">
			        	<p style="margin: 0;"> {{ $image->name }} </p>
			        	@if($image->product_id == NULL)
			        		<a href="#" data-toggle="modal" data-target="#confirm-modal-delete-{{$image->id}}" > <i class="fa fa-trash-o"></i> Delete</a>
			        	@endif

			        	<form method="post" action="/koibento/admin/image/{{$image->id}}">
		    				@method('PATCH')
		    				@csrf
	    					
	    					<input type="checkbox" name="slide" onChange="this.form.submit()" <?php if($image->used_as_slide != 0){ echo 'checked';}?>>

	    					<label for="completed" class="<?php if($image->used_as_slide != 0){ echo 'text-primary';}?>"> Used as slide</label>

	    				</form>

			   		</div>
			    </div>

			    <!-- modal delete image -->
			    <div class="modal fade" id="confirm-modal-delete-{{$image->id}}">
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
			                    <p>Are you sure want to delete this image?</p>

			                </div>
			                <div class="modal-footer">

			                	<form method ="POST" action="/koibento/admin/image/{{$image->id}}">

			                		@method('DELETE')
			                		@csrf

			                        <button type="submit" class="btn btn-primary">Yes</button>
			                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

			                    </form>

			                </div>
			            </div>
			        </div>
			        <!-- /modal delete image -->

			    </div>

		    @endforeach

		</div>
		<div class="row" style="justify-content: center;">
		    {{ $images->links() }}
		</div>

	</article>
@endsection