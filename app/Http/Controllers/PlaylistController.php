<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Comment;

class PlaylistController extends BaseController
{
    public function index() {
        return Playlist::all();
    }

    public function getPlaylist($id) {
        $playlist = Playlist::find($id);
        $comments = $playlist->comments;
        foreach ($comments as $comment) {
            $responses = $comment->responses;
        }
        $songs = $playlist->songs;
        return $playlist;
    }

    public function getById($id) {
        return response()->json($this->getPlaylist($id));
    }


    public function create(Request $req) {
        try {
            $playlist = new Playlist;
            $playlist->name = $req->name;
            $playlist->description = $req->description;
            $playlist->artwork = $req->artwork;
            $playlist->save();
            return response()->json($playlist);
        }
        catch (Exception $e) {
            return response()->json("Message: ".$e->getMessage(), 400);
        }
    }

    public function comment(Request $req) {
        try {
            $comment = new Comment;
            $comment->author = $req->author;
            $comment->text = $req->text;
            $comment->parent_type = $req->parent_type;
            $comment->save();
            return response()->json($comment);
        }
        catch (Exception $e) {
            return response()->json("Message: ".$e->getMessage(), 400);
        }
    }
}
