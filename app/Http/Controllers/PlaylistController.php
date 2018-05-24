<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Comment;
use App\Models\Artwork;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;
class PlaylistController extends BaseController
{
    public function index() {
        $allplay = Playlist::all();
        for($i = 0 ; $i < count($allplay); $i++){
            $user_id = $allplay[$i]->user_id;
            $allplay[$i]->user_id = User::find($user_id)->name;
        }
        return response()->json(["playlists" => $allplay]);
    }

    public function mostFavourite() {
        $allplay = Playlist::where('favourites','>',0)
                        ->orderBy('favourites', 'desc')
                        ->get();
        for($i = 0 ; $i < count($allplay); $i++){
            $user_id = $allplay[$i]->user_id;
            $allplay[$i]->user_id = User::find($user_id)->name;
        }
        return response()->json(["playlists" => $allplay]);
    }

    public function recommended() {
        $allplay = Playlist::where('recommended',1)
                        ->orderBy('name', 'desc')
                        ->get();
        for($i = 0 ; $i < count($allplay); $i++){
            $user_id = $allplay[$i]->user_id;
            $allplay[$i]->user_id = User::find($user_id)->name;
        }                
        return response()->json(["playlists" => $allplay]);
    }


    public function fromUser($id){
        try{
            $allplay = Playlist::where('user_id',$id)
                        ->get();
            return response()->json(["playlists" => $allplay]);
        }
        catch (Exception $e) {
            return response()->json("error: ".$e->getMessage(), 400);
        }
    }
    public function removePlaylist($id){
        try{
            Playlist::destroy($id);
            Storage::disk('public')->deleteDirectory($id);
            return redirect('/');
        }
        catch (Exception $e) {
            return response()->json("error: ".$e->getMessage(), 400);
        }
        
    }

    public function imageUrl($id){
        return response()->json(["url"=>Playlist::find($id)->url]);
    }

    public function getSearchedPlaylist($string){
        return Playlist::search($string)->get();
    }


    public function incrementFav($id){
        try {
            $playlist = Playlist::find($id);
            $playlist->favourites = $playlist->favourites+1;
            $playlist->save();
            return response()->json(["favourites"=>$playlist->favourites]);
        }
        catch (Exception $e) {
            return response()->json("error: ".$e->getMessage(), 400);
        }
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


    public function getCreator($id){
        $idusr = Playlist::find($id)->user_id;
        return User::where('user_id',$idusr)->get()[0];
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


    public function create(Request $req) {
        
        try {
            $playlist = new Playlist;
            $playlist->name = $req->name;
            $playlist->description = $req->descp;
            $playlist->user_id = Auth::user()->user_id;
            $url = '';
            if($req->artwork == ''){
                $url = '/images/intervalsalbum.jpg';
            }
            else{
                $url = $req->artwork;
            }
            $playlist->url = $url;
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

    public function __construct()
    {
        
    }
}
