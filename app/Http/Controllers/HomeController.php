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
        $latestDecks = Deck::latest()->take(4)->get();
        return view( 'welcome', [ 'latestDecks' => $latestDecks ] );
    }
}
