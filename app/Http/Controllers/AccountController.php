<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\View;


class AccountController extends BaseController
{
    public function logout()
    {
    	Auth::logout();
    	return \View::make('home.welcome', array());
    } 
}