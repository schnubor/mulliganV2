<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

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

        return view( 'user', [ 'user' => $user ] );
    }
}
