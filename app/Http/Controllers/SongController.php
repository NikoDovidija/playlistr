<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Comment;
use App\Models\Song;

class SongController extends BaseController
{
    public function index() {
        return Song::all();
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
