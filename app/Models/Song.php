<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = "songs";
    protected $primaryKey = "song_id";
    protected $fillable = ["playlist_id", "name", "artist", "album", "duration", "playcount"];

    public function playlist() {
        return $this->belongsTo("App\Models\Playlist", "playlist_id");
    }

    public function comments() {
        return $this->hasMany("App\Models\Comment")
                    ->where("comments.parent_type", "song");
    }
}