<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Helper;

class CardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $slug = explode( "-", $id );
        $multiverseid = end( $slug );
        $url = 'https://api.magicthegathering.io/v1/cards/'.$multiverseid;
        $client = new Client();
        try{
            // try code
            $response = $client->get( $url, ['timeout' => 10] );
        } 
        catch(\Exception $e){
           return view( 'error', ['message' => $e, 'url' => $url] );
        }

        $card = json_decode( $response->getBody() );
        $card = $card->card;

        // TODO: Create border color from rarity..

        return view( 'card', ['card' => $card] );
    }
}
