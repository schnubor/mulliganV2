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
            $status = 504;
            $errorMsg = 'Gateway timeout';

            if( $e->getResponse() ) {
                $response = json_decode((string)$e->getResponse()->getBody());
                $status = $response->status;
                $errorMsg = $response->error;
            }
            
            return view( 'error', [
                'message' => $e,
                'url' => $url,
                'status' => $status,
                'errorMsg' => $errorMsg
            ] );
        }

        $card = json_decode( $response->getBody() );
        $card = $card->card;

        // TODO: Create border color from rarity..

        return view( 'card', ['card' => $card] );
    }
}
