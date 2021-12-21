<?php

namespace App\Http\Controllers;

use App\Models\Competitors;
use App\Models\Leagues;
use App\Models\Event;

class HomeController extends Controller
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $competitors = Competitors::count();
        $event = Event::count();
        $leagues = Leagues::count();
        return view('dashboard', compact('competitors', 'event', 'leagues'));
    }
}
