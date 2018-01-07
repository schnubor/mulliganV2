<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $user = User::where( 'name', $name ) -> first();

        $decks = $user->decks;

        return view( 'user.user', [ 'user' => $user, 'decks' => $decks ] );
    }

    /**
	 * Show user settings.
	 *
	 * @return View
	 */
	public function settings()
	{
        $user = User::findOrFail(Auth::user()->id);

		return view( 'user.settings', [ 'user' => $user ] );
	}
}
