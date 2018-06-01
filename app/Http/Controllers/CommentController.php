<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends BaseController
{
    public function index() {
        $comments = Comment::all();
        foreach ($comments as $comment) {
            if ($comment->parent_type === "comment") {
                $comment->responses;
            }
        }
        return response()->json($comments);
    }

    public function getById($id) {
        $comment = Comment::find($id);
        $responses = $comment->responses;
        return response()->json($comment);
    }


    public function create(Request $req) {
        try {
            $comment = new Comment;
            $comment->response_to = $req->response_to;
            $comment->user_id= $req->author;
            $comment->text = $req->text;
            $comment->parent_type = $req->parent_type;
            $comment->save();

            if($req->response_to < 0){
                $comment->response_to = $comment->comment_id;
                $comment->save();
            }
            return response()->json($comment);
        }
        catch (Exception $e) {
            return response()->json("Message: ".$e->getMessage(), 400);
        }
    }

}
