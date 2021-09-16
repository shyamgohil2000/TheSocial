<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikePostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store($post_id){
        $post = Post::find($post_id);
        return auth()->user()->liked()->toggle($post);
    }
}
