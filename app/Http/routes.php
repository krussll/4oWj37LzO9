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


	Route::post('beta/create','API\UsersController@createBeta');

	Route::post('login/auth','API\AuthController@Login');
	Route::post('login/destroy','API\AuthController@Logout');

	Route::get('trades/all', 'API\TradesController@getTrades');
	Route::get('trades/active', 'API\TradesController@getActiveTrades');
	Route::post('trades/complete', 'API\TradesController@completeTrade');
	Route::post('trades/create', 'API\TradesController@createTrade');

	Route::get('hashtags/list', 'API\HashtagsController@getHashtagsList');
	Route::get('hashtags/info', 'API\HashtagsController@getHashtagInfo');
	Route::get('hashtags/latest', 'API\HashtagsController@getLatestHashtags');
	Route::get('hashtags/popular', 'API\HashtagsController@getPopularHashtags');
	Route::get('hashtags/byname', 'API\HashtagsController@getHashtagsByName');
	Route::get('hashtags/id', 'API\HashtagsController@getHashtagById');
	Route::get('hashtags/counts', 'API\HashtagsController@getHashtagCountsById');

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
	Route::get('/hashtag/search/{term}', ['uses' =>'HashtagController@search']);
	Route::get('/hashtags/list', ['uses' =>'HashtagController@listHashtags']);
	Route::get('/hashtag/{id}', ['uses' =>'HashtagController@show']);
	Route::get('/leagues', ['uses' =>'LeagueController@index']);
	Route::get('/league/{id}', ['uses' =>'LeagueController@show']);
	Route::get('/leagues/create', ['uses' =>'LeagueController@create']);
});

//Route::get('user/show/{id}', ['uses' =>'UserController@show']);

Blade::setEscapedContentTags('[[', ']]');
Blade::setContentTags('[[[', ']]]');
