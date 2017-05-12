<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Cocur\Slugify\Slugify;
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
        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:140',
            'description'   => 'string|nullable',
            'decklist'      => 'required|json',
            'tags'          => 'json',
            'ownerId'       => 'required|numeric'
        ]);

        // Return validation errors as JSON
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        // Store the Deck
        $deck = new Deck;

        $deck->title = $request->title;
        $deck->description = $request->description;
        $deck->decklist = $request->decklist;
        $deck->colors = $request->colors;
        $deck->tags = $request->tags;
        $deck->owner_id = $request->ownerId;
        $deck->views = 0;
        $deck->likes = 0;

        $deck->save();

        // return success response
        $slugify = new Slugify();
        if ( $deck ) {
            return response()->json([ 
                'message' => 'SUCCESS',
                'deckname' => $slugify->slugify( $deck->title ) . '-' . $deck->id
            ], 200);
        }

        // return error if something went wrong
        return response()->json([ 
            'message' => 'ERROR'
        ], 500);
    }
}
