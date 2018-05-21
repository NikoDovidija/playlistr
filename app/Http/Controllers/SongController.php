<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Comment;
use App\Models\Song;

class SongController extends BaseController
{
    public function index() {
        return Song::all();
    }

    public function getById($id) {
        $file = Storage::get("Intervals - Fable.mp3");
        $response = new BinaryFileResponse($file);
        BinaryFileResponse::trustXSendFileTypeHeader();
        return $response;
    }

    public function returnUrls($id) {
        $allplay = Song::where('playlist_id',$id)
            ->get(); 
        $newarr = array();
        for($i = 0 ; $i < count($allplay); $i++){
            $url = "/public/storage/".$id.'/'.explode("/",$allplay[$i]->song_url)[2];
            $newarr[] = array("url" => $url,"name"=>$allplay[$i]->name,"artist"=>$allplay[$i]->artist,"howl"=>null);
            // $newarr[] = $url;
            //$file = Storage::disk('public')->Storage::get("Intervals - Fable.mp3");
            //$file = Storage::get("Intervals - Fable.mp3");
            //$response = new BinaryFileResponse($file);
            //BinaryFileResponse::trustXSendFileTypeHeader();
            } 
        return json_encode($newarr);
    }

    public function create(Request $req) {
        try {
            $song = new Song;
            $song->playlist_id = $req->playlist_id;
            $song->name = $req->name;
            $song->artist = $req->artist;
            $song->album = $req->album;
            $song->artwork = $req->artwork;
            $song->save();
            return response()->json($song);
        }
        catch (Exception $e) {
            return response()->json("Message: ".$e->getMessage(), 400);
        }
    }

}
