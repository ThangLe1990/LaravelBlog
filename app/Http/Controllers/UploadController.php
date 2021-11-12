<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
   public function upload(Request $request) 
   {  
       $path = null;
       
       if ($request->_token) {
           $path = $request ->file('image')->store('uploads');
            
        }
        return view ('upload', [
                'path' => "storage/" . $path
            ]);

            
   }      

    
}