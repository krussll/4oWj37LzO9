<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(array('prefix'=>'/api'),function(){
	Route::get('users/details','API\UsersController@getUserDetails');
	Route::get('users/latest','API\UsersController@getLatestUser');
	Route::post('users/create','API\UsersController@createUser');
	Route::post('users/details/change','API\UsersController@changeUserDetails');
	Route::post('users/password/change','API\UsersController@changeUserPassword');
	Route::get('users/id', 'API\UsersController@getUserById');
	Route::get('user/portfolios', 'API\PortfoliosController@getByUserId');

  Route::post('contact/create', 'API\ContactController@create');

	Route::post('beta/create','API\UsersController@createBeta');

	Route::post('login/auth','API\AuthController@Login');
	Route::post('login/destroy','API\AuthController@Logout');

	Route::get('trades/all', 'API\TradesController@getTrades');
	Route::get('trades/active', 'API\TradesController@getActiveTrades');
	Route::post('trades/complete', 'API\TradesController@completeTrade');
	Route::post('trades/create', 'API\TradesController@createTrade');

	Route::get('profiles/list', 'API\ProfilesController@getHashtagsList');
	Route::get('profiles/info', 'API\ProfilesController@getHashtagInfo');
	Route::get('profiles/latest', 'API\ProfilesController@getLatestHashtags');
	Route::get('profiles/popular', 'API\ProfilesController@getPopularHashtags');
	Route::get('profiles/byname', 'API\ProfilesController@getHashtagsByName');
	Route::get('profiles/id', 'API\ProfilesController@getHashtagById');
	Route::get('profiles/counts', 'API\ProfilesController@getProfilePriceHistoryById');

	Route::get('leagues/{id}', 'API\LeaguesController@getLeague');
	Route::get('leagues/user/positions', 'API\LeaguesController@getUserPositions');
	Route::get('leagues/{id}/positions', 'API\LeaguesController@getLeaguePositions');
	Route::post('leagues/create', 'API\LeaguesController@createLeague');
	Route::post('leagues/join/{code}', 'API\LeaguesController@joinLeague');
});

Route::get('/', function () {
    return view('home.welcome');
});

Route::get('login', function () {
    return view('account.login');
});

Route::get('register-hidden', function () {
    return view('account.register');
});


Route::post('logout','AccountController@Logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', ['uses' =>'DashboardController@index']);
    Route::get('/settings', ['uses' =>'UserController@settings']);
		Route::get('/profiles/search/{term}', ['uses' =>'ProfileController@search']);
		Route::get('/profiles/list', ['uses' =>'ProfileController@listHashtags']);
		Route::get('/profile/{id}', ['uses' =>'ProfileController@show']);
		Route::get('/leagues', ['uses' =>'LeagueController@index']);
		Route::get('/league/{id}', ['uses' =>'LeagueController@show']);
		Route::get('/leagues/create', ['uses' =>'LeagueController@create']);
});

//Route::get('user/show/{id}', ['uses' =>'UserController@show']);

Blade::setEscapedContentTags('[[', ']]');
Blade::setContentTags('[[[', ']]]');
