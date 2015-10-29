<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use View;


class DashboardController extends BaseController
{
    public function index()
    {
    	return View::make('home.index');
    }


}
