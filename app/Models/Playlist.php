<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "playlists";
    protected $primaryKey = "playlist_id";
    protected $fillable = ["name", "description", "artwork"];

    public function songs() {
        return $this->belongsToMany("App\Models\Song");
    }

    public function comments() {
        return $this->hasMany("App\Models\Comment");
    }
}