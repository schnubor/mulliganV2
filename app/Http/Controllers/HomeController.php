<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use App\Deck;
use Helper;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slugify = new Slugify;
        $latestDecks = Deck::latest()->take(4)->get();
        $popularDecks = Deck::orderBy('views', 'DESC')->take(4)->get();

        return view( 'home', [ 'latestDecks' => $latestDecks, 'popularDecks' => $popularDecks ] );
    }
}
