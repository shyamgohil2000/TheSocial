<?php

namespace App\Http\Controllers;

use App\Events\FollowerAdded;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\newFollower;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(User $user){
        if(!auth()->user()->following->contains('user_id',$user->id)){
            FacadesNotification::send($user,new newFollower(auth()->user()->id));
        }
        return auth()->user()->following()->toggle($user->profile);
    }
}
