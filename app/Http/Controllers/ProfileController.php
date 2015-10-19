<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use View;


class ProfileController extends BaseController
{
    public function search($term)
    {
    	return View::make('profile.search', array('term' => $term));
    }

    public function show($id)
    {
    	return View::make('profile.show', array('id' => $id));
    }

    public function listAll()
    {
    	return View::make('profile.list');
    }
}
