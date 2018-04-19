<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Playlist extends Model
{
    protected $table = "playlists";
    protected $primaryKey = "playlist_id";
    protected $fillable = ["creator", "name", "description", "artwork", "times_played", "times_recommended"];



    public function songs() {
        return $this->hasMany("App\Models\Song", "playlist_id", "playlist_id");
    }

    public function comments() {
        return $this->hasMany("App\Models\Comment", "response_to")
                    ->where("comments.parent_type", "playlist");
    }

}