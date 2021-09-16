<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(\App\Models\User $user){
        $follows = (auth()->user()) ? (auth()->user()->following->contains($user->id)) : false;
        $postsCount = Cache::remember('count.posts.'.$user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember('count.followers.'.$user->id, now()->addSeconds(30), function () use ($user) {
            return $user->profile->followers->count();
        });
        $followingCount = Cache::remember('count.following.'.$user->id, now()->addSeconds(30), function () use ($user) {
            return $user->following->count();
        });
        return view('profile.show',compact('user','follows','postsCount','followersCount','followingCount'));
    }

    public function edit(\App\Models\User $user){
        $this->authorize('update',$user->profile);
        return view('edit',compact('user'));
    }

    public function update(\App\Models\User $user){
        $this->authorize('update',$user->profile);
        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>['nullable','url'],
            'image'=>['nullable','image']
        ]);
        if(request('image')){
            $imagePath = request('image')->store('profile','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(200,200);
            $image->save();
            $imgArr = ['image'=>$imagePath,];
        }
        auth()->user()->profile->update(array_merge($data,$imgArr??[]));
        return redirect('/users/'.$user->id);
    }
}