<?php

namespace App\Http\Controllers\API;

use Auth;
use Input;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    public function Login()
    {
		//return response()->json(array('success' => false));
    	if(Auth::attempt(Input::only('email','password'))){
			return response()->json(array('success' => true));
		}else{
			return response()->json(array('success' => false));
		}
	}
		 
	public Function Logout(){

		Auth::logout();
		return response()->json(array('success' => true));
	}
}

/*

		

		
		*/