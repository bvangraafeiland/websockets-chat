<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUserName = Auth::check() ? Auth::user()->name : 'Guest';
        return view('home', compact('loggedInUserName'));
    }
}
