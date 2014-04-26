<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', 'HomeController@showWelcome');
Route::get('about', function() {
    return View::make('about');
});

Route::resource('users', 'UsersController');
Route::get('/register', 'UsersController@showUserRegistration');
Route::post('/register', 'UsersController@saveUser');
Route::get('sendemail/{id}', 'UsersController@sendWelcomeEmail');
Route::post('users/search', array(
    'as' => 'users.search',
    'uses' => 'UsersController@search')
);

Route::get('contact', 'PagesController@contact');
