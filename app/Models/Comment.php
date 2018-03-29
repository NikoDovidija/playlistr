<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "comments";
    protected $primaryKey = "comment_id";
    protected $fillable = ["author", "text", "parent_type"];

    public function song() {
        return $this->belongsTo("App\Models\Song");
    }

    public function playlist() {
        return $this->belongsTo("App\Models\Playlist");
    }

    public function parentComment() {
        return $this->belongsTo("App\Models\Comment");
    }

    public function replyTo() {
        $parent = $this->parent_type;
        switch ($parent) {
            case "playlist":
                return $this->playlist();
            case "song":
                return $this->song();
            case "comment":
                return $this->parentComment();
        }
    }
}