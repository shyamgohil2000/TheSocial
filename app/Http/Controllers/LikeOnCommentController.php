<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class LikeOnCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store($comment_id){
        $comment = Comments::find($comment_id);
        return auth()->user()->likedComment()->toggle($comment);
    }
}
