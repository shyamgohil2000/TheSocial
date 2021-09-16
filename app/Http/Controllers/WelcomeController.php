<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class WelcomeController extends Controller
{
    public function users(){
        $users = User::all()->sortDesc();
        return view('welcome', compact('users'));
    }
}
