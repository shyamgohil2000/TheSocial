@extends('layouts.app')
@section('content')
    <div class="container">
        <table style="margin: 2%; width:98%">
            <tr style="position: relative; top:-30px;">
                <td style="width: 12%; padding-top: 30px;">
                    <img src="{{$user->profile->profileImage()}}" alt="Profile Photo" style="border: 1px solid transparent; border-radius: 50%;">
                </td>
                <td style="vertical-align: top; min-width: 28%">
                    <h1 style="position: relative; left:40px; top:30px; font-size: xx-large">{{$user->name}}</h1>
                    @can('update', $user->profile)
                        <a href="/users/{{$user->id}}/edit" style="position: absolute; left:700px; top:60px; padding:5px; border:1px solid black; border-radius: 7px;">Edit Profile</a>
                    @endcan
                    <p class="pt-20 pl-10"><strong>{{$user->posts->count()}}</strong> Posts &emsp; <strong>25</strong> Followers &emsp; <strong>25</strong> Following</p>
                </td>
                <td style="width: auto;">
                    <x-button style="position: absolute; left:600px; top:60px;">Follow</x-button>
                </td>
            </tr>
            <tr class="pt-10">
                <td style="vertical-align: top; padding-left: 10px;">
                    <div class="pb-10">
                        <a href="/users/{{$user->id}}"><b>{{'@'}}{{$user->username}}</b></a>
                    </div>
                    <style>
                        li{
                            background-color: lightgreen;
                            border: 2px solid white;
                        }
                    </style>
                    <ul>
                        <li>
                            <div class="pt-3 pl-3">
                                <b>{{$user->profile->title}}</b>
                            </div>
                        </li>
                        <li>
                            <div class="pl-3">
                                {{$user->profile->description}}
                            </div>                    
                        </li>
                        <li>
                            <div class="pt-4 pl-3">
                                {{$user->profile->url ?? ''}}
                            </div>
                        </li>
                    </ul>
                </td>
                @can('update', $user->profile)
                <td style="vertical-align: top; padding-left: 20px;">
                    <h3><b>Add new Post</b></h3>
                    <form action="/p" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-label for="caption" :value="__('Caption')" />
            
                            <x-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')" required autofocus />
                        </div>
                        <div>
                            <x-label for="description" :value="__('Description')" />
            
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
                        </div>
                        <div>
                            <x-label for="image" :value="__('Image')" />
            
                            <input id="image" class="block mt-1 w-full" type="file" name="image" required autofocus />
                        </div>
                        <div class="pt-5">
                            
                            <x-button class="">
                                POST
                            </x-button>
                        </div>
                    </form>
                </td>
                @endcan
                <style>
                    .grid-container{
                        display: grid;
                        grid-template-columns: auto auto auto;
                        margin-left: 10px;
                    }
                    .grid-item{
                        width: 250px;
                        height: 250px;
                        margin-right: 20px;
                        margin-bottom: 20px;
                    }
                </style>
                <td class="grid-container">
                    @foreach ($user->posts as $post)
                    <div class="grid-item">
                        <a href="/p/{{$post->id}}">
                            <img src="/storage/{{$post->image}}" alt="">
                        </a>
                    </div>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
@endsection