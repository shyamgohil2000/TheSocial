@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($posts as $post)
        <div class="col-3 mx-3 my-3 px-4 pt-2" style="border: 1px solid cornflowerblue; border-radius: 10px; position: relative; height: 90vh;">
            <div class="row">
                <a href="/p/{{$post->id}}" class="w-100">
                    <img src="/storage/{{$post->image}}" class="w-100 rounded">
                </a>
            </div>

            <div class="row justify-content-end pr-1" style="font-size: x-small;">
                Posted {{$post->created_at->diffForHumans()}}
            </div>
            
            <div class="row d-flex px-1 py-1 mt-2">
                <div class="col-2 ml-0 pl-0">
                    <img src="{{$post->user->profile->profileImage()}}" alt="" class="rounded-circle" style="width: 4vw;">
                </div>
                <div class="col-6 align-self-center">
                    <a href="/users/{{$post->user->id}}"><h5><b>{{'@'}}{{$post->user->username}}</b></h5></a>
                </div>
            </div>
            
            <hr>

            <div class="row d-flex px-0 py-0 ml-1">
                <div class="col-10">
                    <a href="/users/{{$post->user->id}}"><b>{{'@'}}{{$post->user->username}}</b></a>
                </div>
                <div class="col-10 mt-2">
                    <p style="font-size: medium;"><b>{{$post->caption}}</b></p>
                    <p>{{$post->description}}</p>
                </div>
                
            </div>
            <div class="row" id="botdiv" style="position: absolute; bottom: 1vh; left:0.5vw;">
                <div class="col-12 ml-1 mr-0 pr-0">
                    <a href="p/{{$post->id}}" style="text-decoration: none">{{$post->likes->count()}}&nbsp;&nbsp;Likes</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="p/{{$post->id}}" class="py-1 px-2" style="text-decoration: none;">{{$post->comments->count()}} Comments</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-10 d-flex justify-content-center" style="max-height: 10vh;">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
