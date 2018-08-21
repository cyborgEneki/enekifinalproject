<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Event;
use Illuminate\Http\Request;

class PageController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function events_index()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(15);

        return view('events.index')->with('events', $events);
    }

    public function activities_index()
    {
        $activities = Activity::all();

        return view('activities')->with('activities', $activities);
    }

    public function login_index()
    {
        return view('auth.login');
    }
}
