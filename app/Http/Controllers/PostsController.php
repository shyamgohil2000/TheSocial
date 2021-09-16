<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Reply;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Paginator::useBootstrap();
    }
    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(9);
        if($posts->all() == []){
            return redirect('/users/'.auth()->user()->id);
        }
        return view('home', compact('posts'));
    }
    public function store(){
        $this->authorize('update',auth()->user()->profile);
        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(250,250);
        $image->save();
        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'description'=>$data['description'],
            'image'=>$imagePath,
        ]);
        return redirect('users/'.auth()->user()->id);
    }
    public function show(\App\Models\Post $post){
        $liked = (auth()->user()) ? (auth()->user()->liked->contains($post->id)) : false;
        $user = auth()->user();
        $comments = $post->comments()->latest()->paginate(5);
        return view('posts.show',compact('post','user','liked','comments'));
    }
}
