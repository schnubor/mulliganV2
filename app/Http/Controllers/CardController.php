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
        try{
            // try code
            $response = $client->get( $url, ['timeout' => 10] );
        } 
        catch(\Exception $e){
           return view( 'error', ['message' => $e, 'url' => $url] );
        }

        $card = json_decode( $response->getBody() );
        $card = $card->card;
        $text = "";

        // Replace text with Symbols in card text
        if( isset( $card->text ) ) {
            $pattern = array();
            $pattern[0] = '/{T}/';
            $pattern[1] = '/{R}/';
            $pattern[2] = '/{U}/';
            $pattern[3] = '/{G}/';
            $pattern[4] = '/{W}/';
            $pattern[5] = '/{B}/';
            $pattern[6] = '/{C}/';
            $pattern[7] = '/{S}/';
            $pattern[8] = '/{B\/P}/';
            $pattern[9] = '/{E}/';
            $pattern[10] = '/{(\d)}/';

            $replacement = array();
            $replacement[0] = '<i class="ms ms-tap ms-cost"></i>';
            $replacement[1] = '<i class="ms ms-fw ms-r ms-cost"></i>';
            $replacement[2] = '<i class="ms ms-u ms-cost"></i>';
            $replacement[3] = '<i class="ms ms-g ms-cost"></i>';
            $replacement[4] = '<i class="ms ms-w ms-cost"></i>';
            $replacement[5] = '<i class="ms ms-b ms-cost"></i>';
            $replacement[6] = '<i class="ms ms-c ms-cost"></i>';
            $replacement[7] = '<i class="ms ms-s ms-cost"></i>';
            $replacement[8] = '<i class="ms ms-p ms-cost"></i>';
            $replacement[9] = '<i class="ms ms-e ms-cost"></i>';
            $replacement[10] = '<i class="ms ms-fw ms-\1 ms-cost"></i>';

            $text = preg_replace( $pattern, $replacement, $card->text );
        }

        // TODO: Create border color from rarity..

        return view( 'card', ['card' => $card, 'text' => $text] );
    }
}
