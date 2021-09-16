@extends('layouts.app')
@section('content')
<div class="row mx-3" style="width: fit-content;">
    <div class="col-6 mr-0 ml-4">
        <div class="row ml-3 my-3 mr-0" style="width: 55vw;">
            <div class="col-10 mx-0 px-0">
                <h4>Latest Users:</h4>
            </div>
            @foreach ($users->slice(0,6) as $user)
            <div class="col-3 mx-2 my-2 px-0 py-0" style="border: 1px solid lightgray; border-radius: 1vw;">
                <div class="row justify-content-center mt-3">
                    <a href="/users/{{$user->id}}">
                        <img src="{{$user->profile->profileImage()}}" alt="" class="rounded-circle" style="width: 10vw;">
                    </a>
                </div>

                <div class="row mt-2 ml-2">
                    <a href="/users/{{$user->id}}">
                        <strong style="color: dimgray; font-size: medium;">{{$user->username}}</strong>
                    </a>
                </div>

                <div class="row justify-content-end mr-2 mt-2" style="font-size: 1.8vh;">
                    Joined {{$user->created_at->diffForHumans()}}
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-3 mt-5 pt-2 mx-0">
        <div class="card row" style="width: 40vw;">
            <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-8">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mt-3 row mb-0">
                        <div class="col-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>
@endsection