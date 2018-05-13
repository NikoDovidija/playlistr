<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Comment;
use App\Models\Artwork;
use App\User;
class PlaylistController extends BaseController
{
    public function index() {
        $allplay = Playlist::all();
        $urlarr = array();
        $usrarr = array();
        for($i = 0 ; $i < count($allplay); $i++){
            $user_id = $allplay[$i]->user_id;
            $art_id = $allplay[$i]->artwork_id;
            $allplay[$i]->artwork_id = Artwork::find($art_id)->url;
            $allplay[$i]->user_id = User::find($user_id)->name;
            //$urlarr[$id] = Artwork::find($id)->url;
            //$usrarr[$id] = User::find($id)->name;
        }
        return response()->json(["playlists" => $allplay]);
    }

    public function getSearchedPlaylist($string){
        return Playlist::search($string)->get();
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

    public function getSongs($id) {
        $songs = Playlist::find($id)->songs;
        return response()->json(["songs" => $songs]);
    }

    public function getComments($id) {
        $comments = Playlist::find($id)->comments;
        foreach ($comments as $comment) {
            $responses = $comment->responses;
        }
        return response()->json(["comments" => $comments]);
    }

    public function getById($id) {
        return response()->json($this->getPlaylist($id));
    }


    public function create(Request $req) {
        try {
            $playlist = new Playlist;
            $playlist->name = $req->name;
            $playlist->description = $req->descp;
            $playlist->user_id = 1;
            $playlist->save();
            
            
            $artwork = new Artwork;
            $artwork->playlist_id = $playlist->playlist_id;
            if($req->artwork == ''){
                $artwork->url = '/images/intervalsalbum.jpg';
            }
            else{
                $artwork->url = $req->artwork;
            }
            $artwork->save();
            $playlist->artwork_id = $artwork->artwork_id;
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
