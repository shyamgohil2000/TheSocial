<div class="col-12">
    @foreach ($comment->replies as $reply)
    <div class="row py-2 px-0 mx-0 mt-3" style="border: 1px solid royalblue; border-radius: 1vw;">
        <div class="col-2 ml-0 pl-2">
            <img src="{{\App\Models\User::find($reply->user_id)->profile->profileImage()}}" style="width: 4vw;" class="rounded" alt="">
        </div>
        <div class="col-7">
            <div class="row">
                <div style="font-size: medium;">{{\App\Models\User::find($reply->user_id)->username}}</div>
                <div class="ml-3" style="font-size: smaller;">{{$reply->created_at->diffForHumans()}}</div>
            </div>
            <div class="row">
                <a href="">{{'@'}}{{$comment->user->username}}</a>&nbsp;&nbsp;&nbsp;{{$reply->comment}}
            </div>
        </div>
        <div class="col-12 justify-content-end d-flex">
            <div class="mr-3 mt-2">
                {{$reply->likes->count()}}&nbsp;&nbsp;Likes
            </div>
            <div class="mr-3 mt-2">
                {{$reply->replies->count()}}&nbsp;&nbsp;Replies
            </div>
            <div class="mr-2">
                <commentlikebtn-component likedoncomment="{{(auth()->user()) ? (auth()->user()->likedComment->contains($reply->id)) : false}}" comment_id="{{$reply->id}}"></commentlikebtn-component>
            </div>
            <div>
                <button class="btn btn-primary" onclick="showReplies({{$reply->id}})">Reply</button>
            </div>
        </div>
    </div>
    <div id="{{$reply->id}}" class="row mx-4 mt-2" style="display: none;">
        <form method="POST" action="/reply/{{$reply->id}}">
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
    @include('posts.replynest',['comment'=>$reply])
    @endforeach
</div>