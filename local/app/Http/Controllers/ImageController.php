<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Image;


class ImageController extends Controller
{


    public function imageUpload()
    {

        return view('admin.imageUpload');

    }


    public function imageStore()
    {

        $images = DB::table('images')
        ->orderBy('created_at', 'DESC')
        ->paginate(12);

        return view('admin.imageStore', compact('images'));

    }


    public function imageUploadPost()
    {

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
  
        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);

        $image = new Image();

        $image->name = $imageName;

        $image->save();


        return back()

            ->with('success','You have successfully upload image.')

            ->with('image', asset("local/public/images/$imageName"));

    }


    public function imageDelete(Image $image)
    {

        $image->delete();

        return redirect('/admin/image')
        ->with('delete_success', 'Delete image successfully !');

    }

     public function imageSlide(Image $image)
    {
        
        if($image->used_as_slide == 0){

            $image = DB::table('images')
            ->where('id','=', $image->id)
            ->update(['used_as_slide' => 1]);

        }else{

            $image = DB::table('images')
            ->where('id','=', $image->id)
            ->update(['used_as_slide' => 0]);

        }

        return redirect('/admin/image')
        ->with('slide_success', 'Add new slide successfully !');

    }


}