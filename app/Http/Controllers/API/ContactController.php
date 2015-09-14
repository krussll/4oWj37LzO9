<?php

namespace App\Http\Controllers\API;

use Input;
use Auth;
use App\Contact;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\HashtagsRepository as HashtagsRepository;
use App\Repositories\UsersRepository as UsersRepository;

class ContactController extends BaseController
{
    public function create()
    {
      $contact = Contact::create([
              'email' => Auth::user()->email,
              'subject' => Input::get('subject'),
              'message' => Input::get('message')
          ]);

        return response()->json(array('success' => true));
    }
}
