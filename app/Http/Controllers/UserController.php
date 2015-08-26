<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use View;


class UserController extends BaseController
{
    public function show($id)
    {
    	return View::make('user.show', array('id' => $id));
    }

    public function settings()
    {
    	return View::make('user.settings');
    }
}