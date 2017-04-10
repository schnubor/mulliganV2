<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Deck;
use Helper;

class DeckController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        return view( 'deckbuilder' );
    }

    /**
     * Create a new deck instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the request...

        $deck = new Deck;

        $deck->title = $request->title;
        $deck->description = $request->description;
        $deck->decklist = $request->decklist;
        $deck->owner_id = null;

        $deck->save();
    }
}
