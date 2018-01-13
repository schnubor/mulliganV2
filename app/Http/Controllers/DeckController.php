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
use App\Events\DeckViewed;


class DeckController extends Controller
{
    /**
     * Show the deckbuilder
     *
     * @return Response
     */
    public function deckbuilder()
    {
        return view( 'deckbuilder' );
    }

    /**
     * Show a Deck
     *
     * @param  int  $id
     * @return Response
     */
    public function show( $id ) {
        $slug = explode( "-", $id );
        $deckid = end( $slug );

        $deck = Deck::find( $deckid );
        $user = $deck->user;
        
        event( new DeckViewed( $deck ) );
        
        return view( 'deck', [ 'deck' => $deck, 'user' => $user ] );
    }

    /**
     * Show the form for editing the specified deck.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id )
    {
        $slug = explode( "-", $id );
        $deckid = end( $slug );

        $deck = Deck::find( $deckid );

        return view( 'deckedit', [ 'id' => $deckid, 'title' => $deck->title] );
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
            'format'        => 'required|string',
            'wip'           => 'required|boolean',
            'cardcount'     => 'numeric',
            'ownerId'       => 'required|numeric|nullable'
        ]);

        // Return validation errors as JSON
        if ( $validator->fails() ) {
            return response()->json( $validator->messages(), 400 );
        }

        // Store the Deck
        $deck = new Deck;

        $deck->title = $request->title;
        $deck->description = $request->description;
        $deck->format = $request->format;
        $deck->decklist = $request->decklist;
        $deck->colors = $request->colors;
        $deck->tags = $request->tags;
        $deck->user_id = $request->ownerId;
        $deck->wip = $request->wip;
        $deck->cardcount = $request->cardcount;
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

    /**
     * Get Deck Information from API
     *
     * @param  deck ID $id
     * @return Response
     */
    public function apiget( $id ) {
        $deck = Deck::find( $id );

        return $deck;
    }

    /**
     * Update Deck Information via API
     * 
     * @param  request Data $request
     * @param  deck ID $id
     * @return Response
     */
     public function apiedit( Request $request, $id ) {
        // Validation
        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:140',
            'description'   => 'string|nullable',
            'decklist'      => 'required|json',
            'tags'          => 'json',
            'format'        => 'required|string',
            'wip'           => 'required|boolean',
            'cardcount'     => 'numeric',
            'ownerId'       => 'required|numeric|nullable'
        ]);

        // Return validation errors as JSON
        if ( $validator->fails() ) {
            return response()->json( $validator->messages(), 400 );
        }

        // Store the Deck
        $deck = Deck::findOrFail( $id );

        $deck->title = $request->title;
        $deck->description = $request->description;
        $deck->format = $request->format;
        $deck->decklist = $request->decklist;
        $deck->colors = $request->colors;
        $deck->tags = $request->tags;
        $deck->user_id = $request->ownerId;
        $deck->wip = $request->wip;
        $deck->cardcount = $request->cardcount;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $deck = Deck::find($id);
        $deck->delete();

        // redirect
        // Session::flash('message', 'Successfully deleted the nerd!');
        return redirect()->route('user', $deck->user->name);
    }
}
