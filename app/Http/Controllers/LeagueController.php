<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use View;


class LeagueController extends BaseController
{
    public function index()
    {
    	return View::make('league.index', array());
    }

    public function showPrivate($id)
    {
    	//do some checks here
    	return View::make('league.show', array('type' => 'private', 'id' => $id));
    }

    public function create()
    {
    	return View::make('league.create', array());
    }
}