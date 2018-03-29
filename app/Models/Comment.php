<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $primaryKey = "comment_id";
    protected $fillable = ["response_to", "author", "text", "parent_type"];

    public function responses() {
        return $this->hasMany("App\Models\Comment", "response_to")->where("parent_type", "comment");
    }

    public function parent() {
        $parent = $this->parent_type;
        switch ($parent) {
            case "playlist":
                return $this->playlist();
            case "song":
                return $this->song();
            case "comment":
                return $this->comment();
        }
    }

    public function song() {
        return $this->belongsTo("App\Models\Song", "response_to");
    }

    public function playlist() {
        return $this->belongsTo("App\Models\Playlist", "response_to");
    }


    public function comment() {
        return $this->belongsTo("App\Models\Comment", "response_to");
    }
    
}