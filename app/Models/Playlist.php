<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
class Playlist extends Model
{
    use Searchable;
    protected $table = "playlists";
    protected $primaryKey = "playlist_id";
    protected $fillable = ["user_id", "name", "description", "artwork_id", "times_played", "times_recommended"];



    public function songs() {
        return $this->hasMany("App\Models\Song", "playlist_id", "playlist_id");
    }

    public function comments() {
        return $this->hasMany("App\Models\Comment", "response_to")
                    ->where("comments.parent_type", "playlist");
    }

    public function artwork(){
        return $this->hasOne("App\Models\Artwork");
    }

    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}