<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Playlist as Playlist;

class PlaylistController extends BaseController
{
    public function index() {
        return Playlist::all();
    }

    public function create(Request $req) {
        try {
            $playlist = new Playlist;
            $playlist->name = $req->name;
            $playlist->description = $req->description;
            $playlist->save();
            return response()->json();
        }
        catch (Exception $e) {
            return response()->json("Message: ".$e->getMessage(), 400);
        }
    }
}
