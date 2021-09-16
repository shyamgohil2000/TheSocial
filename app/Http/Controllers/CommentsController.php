<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function store($user_id, Post $post){
        $data = request()->validate([
            'comment' => 'required',
        ]);
        $post->comments()->create([
            'comment' => $data['comment'],
            'user_id' =>$user_id,
        ]);

        return redirect('p/'.$post->id);
    }
    public function storeReply($comment_id){
        $user = auth()->user();
        $data = request()->validate([
            'comment' => 'required',
        ]);
        $comment = Comments::find($comment_id);
        $comment->replies()->create([
            'comment'=>$data['comment'],
            'user_id'=>$user->id,
            'post_id'=>$comment->post_id,
        ]);
        return redirect('p/'.$comment->post_id);
    }
}
