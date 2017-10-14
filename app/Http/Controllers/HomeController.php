<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use App\Deck;
use Helper;

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
        $popularDecks = Deck::orderBy('likes', 'DESC')->take(4)->get();
        // Create deck links for latestDecks
        foreach ($latestDecks as $index => $deck) {
            $latestDecks[ $index ]->link = '/decks/' . $slugify->slugify( $deck->title ) . '-' . $deck->id;
        }
        // Create deck links for popularDecks
        foreach ($popularDecks as $index => $deck) {
            $popularDecks[ $index ]->link = '/decks/' . $slugify->slugify( $deck->title ) . '-' . $deck->id;
        }
        return view( 'home', [ 'latestDecks' => $latestDecks, 'popularDecks' => $popularDecks ] );
    }
}
