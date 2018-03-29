<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "songs";
    protected $primaryKey = "song_id";
    protected $fillable = ["name", "artist", "album", "duration", "playcount", "artwork"];

    public function playlists() {
        return $this->belongsToMany("App\Models\Playlist");
    }

    public function comments() {
        return $this->hasMany("App\Models\Comment");
    }
}