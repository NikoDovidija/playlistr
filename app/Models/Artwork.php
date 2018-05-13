<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $table = "artwork";
    protected $primaryKey = "artwork_id";
    protected $fillable = ["playlist_id","url"];

    public function playlist() {
        return $this->belongsTo("App\Models\Playlist");
    }
    
}
