<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Song;
require 'vendor/autoload.php';
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

    public function uploadMusic(Request $request,$id){
        try {
            $attachments = $request->file('attachments');
            $arr = $request->attinfo;
            $converted_arr = array();
            foreach($arr as $key => $inf){
                $converted = json_decode($inf);
                $index = $converted->index;
                $converted_arr[$index]=[$converted->artist,$converted->songname];
            }
            
            for($i=0;$i<count($attachments);$i++){
                $fileName='';
                $artistname = $converted_arr[$i][0];
                $songname = $converted_arr[$i][1];
                if(!empty($artistname)&&!empty($songname)){
                    $fileName = $artistname."-".$songname.'.'.$attachments[$i]->getClientOriginalExtension();
                }
                else{
                    $fileName = $attachments[$i]->getClientOriginalName();
                }
                Storage::disk('public')->putFileAs($id, $attachments[$i], $fileName);
                $url = 'public'.Storage::url($fileName);

                $song = new Song;
                $song->playlist_id = $id;
                $song->name = $songname;
                $song->artist = $artistname;
                $song->album = '';
                $song->song_url = $url;
                $song->save();
            }

            return response()->json(["success" => true,"url"=>$url],200);
        }
        catch (Exception $e) {
            return response()->json("Message: ".$e->getMessage(), 400);
        }
    }

    public function removeThumbnail(Request $request){
        $url = str_replace('public/storage/','',$request->url);
        Storage::disk('public')->delete($url);
        return response()->json(["erased" => "yes"]);
    }
}
