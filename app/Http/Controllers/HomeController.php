<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Cocur\Slugify\Slugify;
use App\Deck;
use Helper;

class HomeController extends Controller
{

    /**
     * Show Welcome Page
     *
     * @param  int  $id
     * @return Response
     */
    public function show() {
        $slugify = new Slugify;
        $latestDecks = Deck::latest()->take(4)->get();

        // Create deck links
        foreach ($latestDecks as $index => $deck) {
            $latestDecks[ $index ]->link = '/decks/' . $slugify->slugify( $deck->title ) . '-' . $deck->id;
        }

        return view( 'welcome', [ 'latestDecks' => $latestDecks ] );
    }
}
