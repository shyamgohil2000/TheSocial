@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="position: absolute; left:0vw; width: inherit; padding:0%; margin: 0%;">
            <div class="col-2 pl-4" style="height:100vh;">
                <div class="col-10 pt-3" style="padding: 0%; margin: 0%;">
                    <img src="{{$user->profile->profileImage()}}" alt="Profile Photo" class="rounded-circle" style="width: 15vw;">
                </div>
                <div class="row">
                    <a href="/users/{{$user->id}}" class="ml-4 mt-4"><b>{{'@'}}{{$user->username}}</b></a>
                </div>
                <div class="row mt-3">
                    <ul>
                        <li>
                            <div class="">
                                <b>{{$user->profile->title}}</b>
                            </div>
                        </li>
                        <li>
                            <div class="">
                                {{$user->profile->description}}
                            </div>                    
                        </li>
                        <li>
                            <div class="">
                                <a href="{{$user->profile->url ?? ''}}">{{$user->profile->url ?? ''}}</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-10 pl-3 pt-2" style="padding:0%; margin: 0%; display: inline;">
                <div class="row" style="padding: 0%; margin: 0%;">
                    <div class="col-5 pt-3 pl-3" style="height: 30vh;">
                        <h1 class="mt-4">{{$user->name}}</h1>
                        <div class="mt-4 d-flex">
                            <a href="/posts/showall" style="text-decoration: none; color: black;" class="ml-3"><strong>{{$postsCount}}</strong> Posts</a>
                            <a href="/profile/followersview" style="text-decoration: none; color: black;" class="ml-3"><strong>{{$followersCount}}</strong> Followers</a>
                            <a href="/profile/followingview" class="ml-3" style="text-decoration: none; color: black;"><strong>{{$followingCount}}</strong> Following</a>
                        </div>
                    </div>
                    <div class="col-7 d-flex" style="height: 30vh;">
                        <followbtn-component user-id="{{$user->id}}" follows={{$follows}}></followbtn-component>
                        @can('update', $user->profile)
                            <a href="/users/{{$user->id}}/edit" class="btn ml-2 align-self-center mb-4" style="background-color: crimson; color: white">Edit Profile</a>
                        @endcan
                    </div>
                </div>
                <div class="row" style="padding: 0%; margin: 0%;">
                    <div class="col-10 mt-3">
                        @can('update', $user->profile)
                        <h5><b>Add new Post</b></h5>
                        <form action="/p" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="caption" class="col-md-1 col-form-label text-md-right">{{ __('Caption') }}</label>
    
                                <div class="col-md-6">
                                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>
    
                                    @error('caption')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-1 col-form-label text-md-right">{{ __('Description') }}</label>
    
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
    
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="image" class="col-md-1 col-form-label text-md-right">{{ __('Image') }}</label>
    
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required autocomplete="image" autofocus>
    
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endcan
                        <div class="row mt-4 justify-content-start">
                            @foreach ($user->posts as $post)
                                <div class="col-3 my-2 mx-3 py-0">
                                    <a href="/p/{{$post->id}}">
                                        <img src="/storage/{{$post->image}}" alt="" class="rounded" >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-2">
                        SideBar<br>
                        for future purpose
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection