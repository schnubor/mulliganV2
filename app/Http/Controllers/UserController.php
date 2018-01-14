<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;

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
    
    /**
	 * POST edit password form
	 **/
	public function editPassword(EditPasswordRequest $request){
		$user = User::find(Auth::user()->id);
		$old = $request->input('old');
        $new = $request->input('new');
        
		if(Hash::check($old, $user->getAuthPassword())){
			$user->password = bcrypt($new);
			if($user->save()){
                \Session::flash('password_edit_success', '(づ￣ ³￣)づ Password changed.');
				return redirect()->route('usersettings', $user->name);
            }
            
            \Session::flash('password_edit_db_error', 'ಠ_ಠ Something went wrong. Please try again.');
			return redirect()->route('usersettings', $user->name);
        }
        
        \Session::flash('password_edit_error', '¯\_(ツ)_/¯ Passwords don\'t match.');
		return redirect()->route('usersettings' , $user->name);
	}
}
