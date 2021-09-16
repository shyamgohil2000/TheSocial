@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-4">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        <div class="col-4">
            <div class="row d-flex mt-2">
                <div class="col-3">
                    <img src="{{$post->user->profile->profileImage()}}" alt="" class="rounded-circle" style="max-width: 5vw;">
                </div>
                <div class="col-6 pl-0 align-self-center">
                    <a href="/users/{{$post->user->id}}"><h4><b>{{'@'}}{{$post->user->username}}</b></h4></a>
                </div>
                <div class="col-3 align-self-center pl-0 pb-2">
                    <a href="" class="btn pl-3 pr-3" style="background-color: crimson; color: white;">Follow</a>
                </div>
            </div>
            <hr>

            <div class="row ml-1">
                <div class="col-10">
                    <a href="/users/{{$post->user->id}}"><b>{{'@'}}{{$post->user->username}}</b></a>
                </div>
                <div class="col-10 mt-2">
                    <p style="font-size: large;"><b>{{$post->caption}}</b></p>
                </div>
                <div class="col-10">
                    <p>{{$post->description}}</p>
                </div>
            </div>
        </div>
        <div class="col-8 pl-4">
            Posted: {{$post->created_at->diffForHumans()}}
        </div>
        <div class="col-8 mt-2">
            <div class="row">
                <div class="col-3 d-flex">
                    <div class="">
                        <likebtn-component liked="{{$liked}}" post_id="{{$post->id}}"></likebtn-component>
                    </div>
                    <div class="ml-3 mt-2">
                        <a href="" style="text-decoration: none">{{$post->likes->count()}}&nbsp;&nbsp;Likes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-8">
            <h4>Comments {{$post->comments->count()}}:</h4>
        </div>
        <div class="col-6 my-4">
            <div class="col-12 mx-0 px-0 py-4 mb-5" style="border-top: 1px solid lightgrey; border-bottom: 1px solid lightgrey;">
                <form method="POST" action="/comment/{{ $user->id }}/{{$post->id}}">
                    @csrf
        
                    <div class="row mx-0 px-0">
    
                        <div class="col-2 mx-0 pl-0">
                            <label for="text" class="col-4 col-form-label text-right">{{ __('Comment') }}</label>
                        </div>
    
                        <div class="col-10 mx-0 px-0">
                            <input id="text" type="textbox" class="form-control @error('text') is-invalid @enderror" name="comment" value="{{ old('text') }}" required autocomplete="text" autofocus>
                        </div>
    
                        <div class="col-12">
                            @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
        
                    <div class="row mt-3 mx-0 px-0">
                        <div class="col-10"></div>
                        <div class="col-2 mx-0 px-0">
                            <button type="submit" class="btn px-4" style="background-color: crimson; color:white;">
                                {{ __('Post') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @foreach ($comments as $comment)
            <div class="row px-2 py-2 my-3" style="border: 1px solid steelblue; border-radius: 1vw;">
                <div class="col-2 pl-1">
                    <img src="{{\App\Models\User::find($comment->user_id)->profile->profileImage()}}" alt="" class="rounded" style="width: 5vw;">
                </div>
                <div class="col-8 mt-1">
                    <div class="row">
                        <div>
                            <h5><strong>{{\App\Models\User::find($comment->user_id)->username}}</strong></h5>
                        </div>
                        <div class="col-1"></div>
                        <div style="font-size: small;">
                            {{$comment->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="row">
                        <p>{{$comment->comment}}</p>
                    </div>
                    
                </div>
                <div class="col-12 justify-content-end d-flex">
                    <div class="mr-3 mt-2">
                        {{$comment->likes->count()}}&nbsp;&nbsp;Likes
                    </div>
                    <div class="mr-3 mt-2">
                        {{$comment->replies->count()}}&nbsp;&nbsp;Replies
                    </div>
                    <div class="mr-2">
                        <commentlikebtn-component likedoncomment="{{(auth()->user()) ? (auth()->user()->likedComment->contains($comment->id)) : false}}" comment_id="{{$comment->id}}"></commentlikebtn-component>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="showReplies({{$comment->id}})">Reply</button>
                    </div>
                </div>
            </div>
            <div class="row ml-5 px-0" id="{{$comment->id}}" style="display: none;">
                <div class="col-10">
                    <form method="POST" action="/reply/{{$comment->id}}">
                        @csrf

                        <div class="row">
                            <label for="comment" class="col-2 ml-0 pl-0 col-form-label text-md-right">{{ __('Comment') }}</label>

                            <div class="col-10 mx-0 px-0">
                                <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment" autofocus>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2 mb-0">
                            <div class="col-12 offset-10">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @include('posts.replynest',['comment'=>$comment])
            </div>      
            @endforeach
            <div class="row justify-content-center">
                {{$comments->links()}}
            </div>
        </div>
    </div>
</div>
<script>
    function showReplies(a){
        if (document.getElementById(a).style.display == 'none') {
            document.getElementById(a).style.display = 'block';
        }else{
            document.getElementById(a).style.display = 'none';
        }
    }
</script>
@endsection