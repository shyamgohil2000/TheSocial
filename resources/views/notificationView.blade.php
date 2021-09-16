@extends('layouts.app')
@section('content')
    <div class="row mx-4 d-flex justify-content-center" style="width: auto;">
        @foreach ($notifications as $notification)
            <div class="col-8 mx-5 rounded px-3 py-3" style="border: 1px solid lightgreen;">
                <p>Hi, {{auth()->user()->name}} you have a new Follower.</p>
                <a href="/users/{{$notification->data['follower_id']}}" style="text-decoration: none; font-size: small;">{{'@'}}{{\App\Models\User::find($notification->data['follower_id'])->username}}</a>
            </div>
        @endforeach      
    </div>
@endsection