@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column">
        @foreach (auth()->user()->profile->followers->all() as $followers)
        <div class="row mt-3 py-2 align-self-center" style="width: 50%; border:1px solid powderblue; border-radius: 1vh;">
            <div class="col-2">
                <img src="{{$followers->profile->profileImage()}}" style="width: 5vw" class="rounded-circle" alt="">
            </div>
            <div class="col-6 ml-2 mt-2">
                <a href="/users/{{$followers->id}}" style="font-size: large; text-decoration: none; color: gray;">{{$followers->username}}</a>
            </div>
            <div class="col-3 mt-2 ml-4">
                <followbtn-component user-id="{{$followers->id}}" follows={{(auth()->user()) ? (auth()->user()->following->contains($followers->id)) : false}}></followbtn-component>
            </div>
        </div>
        @endforeach
    </div>
@endsection