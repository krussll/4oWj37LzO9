<?php

namespace App\Http\Controllers\API;
use App\User;
use Input;
use Auth;
use Hash;
use App\BetaRequest;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\UsersRepository as UsersRepository;
use App\Repositories\LeaguesRepository as LeaguesRepository;

class UsersController extends BaseController
{
    public function getLatestUsers()
    {
    	$rep = new UsersRepository();
    	return response()->json($rep->GetLatestUsers());
    }

    public function getUserDetails() {
        return Auth::user();
    }

	public function createUser()
    {
        $user = User::create([
            'firstname' => Input::get('firstname'),
            'surname' => Input::get('surname'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password'))
        ]);

        $rep = new LeaguesRepository(); 

        $rep->AddUserToGlobalLeagues($user->id);

        Auth::attempt(Input::only('email','password'));
    	return response()->json(array('user' => $user, 'success' => true));
    }   

    public function createBeta()
    {
        $user = BetaRequest::create([
            'email' => Input::get('email')
        ]);

        return response()->json(array('success' => true));
    }    
 

    public function changeUserDetails()
    {
        $user = Auth::user();
        $user->firstname = Input::get('firstname');
        $user->surname = Input::get('surname');
        $user->save();

        return response()->json(array('success' => true));
    }

    public function changeUserPassword()
    {  
        $user = Auth::user();

        if (Hash::check(Input::get('currentPassword'), $user->password))
        {
            $user->password = bcrypt(Input::get('newPassword'));

            $user->save();
            return response()->json(array('success' => true));
        }

        return response()->json(array('success' => false, 'message' => 'Your current password is incorrect'));
    }

    public function getUserById()
    {
        $id = Input::get('id');
        
        $rep = new UsersRepository();

        return response()->json($rep->GetUserById($id));
    }
}
