<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Session;
use Redirect;

class Operation extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }


    public function upload(Request $request)
    {
        $hid_flip=$request->input('flip_opt');
        $hid_resize=$request->input('resize_opt');
        $hid_frame=$request->input('frame_opt');
        // return "test";
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $txt= $request->input('img_text');
        $img = Image::make(public_path('images/'.$imageName));  
        $img->text($txt, 120, 100, function($font) {  
            $font->file(public_path('path/arial.ttf'));  
            $font->size(500);  
            $font->color('#000000');  
            $font->align('center');  
            $font->valign('bottom');  
           
        });  
        // $img = Image::make('public/foo.jpg');

// flip image vertically
        if(!empty($hid_flip)){
            $img->flip('h');
        }
        if(!empty($hid_resize)){   
        $img->resize(500, 500);
        }

        if(!empty($hid_frame))
        {
            $inner_img=Image::make(public_path('images/'.$imageName));
           
            $inner_img->resize(1200,1200);
            $img = Image::make(public_path('images/frame.png'));
            $img->insert($inner_img,'center');
            $img->text($txt, 500, 250, function($font) {  
                $font->file(public_path('path/arial.ttf'));  
                $font->size(200);  
                $font->color('#000000');  
                $font->align('center');  
                $font->valign('bottom');  
               
            });
            if(!empty($hid_flip)){
                $img->flip('h');
            }   
        }

       $img->save(public_path('images/download.jpg')); 
        
       //Session::flash('message', "Downloaded Successfully");
       return response()->download(public_path('images/download.jpg'));
    //    return Redirect::back();
        
    }
}
