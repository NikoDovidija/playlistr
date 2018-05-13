<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class UploadController extends Controller

{

    public function uploadSubmit(Request $request)
    {   
        $descp = $request->file('file');
        $request->file('file')->store('songs');
        var_dump($descp);
        return response()->json(["thumb-uri" => $descp->getClientOriginalName()]);

    }

    public function uploadThumbnail(Request $request){
        $image      = $request->file('file');
        $url = '';
        if($image != null){
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(540, 540, function ($constraint) {
                $constraint->aspectRatio();                 
            });
            $img->stream(); // <-- Key point
            Storage::disk('public')->put($fileName, $img, 'public');
            $url = 'public'.Storage::url($fileName);
        }
        return response()->json(["url" => urlencode($url)]);
    }

    public function removeThumbnail(Request $request){
        $url = str_replace('public/storage/','',$request->url);
        Storage::disk('public')->delete($url);
        return response()->json(["erased" => "yes"]);
    }
}
