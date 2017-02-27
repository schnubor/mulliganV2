<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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
        $response = $client->get( $url );
        $card = json_decode( $response->getBody() );
        $card = $card->card;
        return view( 'card', ['card' => $card] );
    }
}
