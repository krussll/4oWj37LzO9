<?php

namespace App\Http\Controllers\API;
use App\User;
use App\Portfolio;
use Input;
use Auth;
use Hash;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\PortfoliosRepository as PortfoliosRepository;

class PortfoliosController extends BaseController
{
    public function getByUserId()
    {
    	if (Auth::user() != null)
    	{
    		$userId = Auth::user()->id;
	        $rep = new PortfoliosRepository();

	        return response()->json($rep->GetByUserId($userId));
    	}else
    	{
    		return response()->json(null);
    	}
        
    }
}
