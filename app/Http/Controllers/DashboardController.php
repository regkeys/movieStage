<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    // bring in user model to use first


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('dashboard');  - this is the original ---   added below for relationships
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('uploads', $user->uploads);

    }


    /**
     * User page for all the users
     *
     *
     */
    public function userprofile()
    {
        $user = User::all();
        return view('internal.user-profile')->with('user', $user);
        /*return User::all();  /* TEST = Gets all the data in the movie database using eloquent by using upload model
                                            - will return an array - comment out return above   */
    }


}
