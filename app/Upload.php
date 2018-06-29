<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function saveImages(Request $request, $image_url)
   {
       $image = new Upload();
       $image->image_name = $request->file('image_name')->getClientOriginalName();
       $image->image_url = $image_url;

       $image->save();
   }
}
