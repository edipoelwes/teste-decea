<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/login', 'AuthController@login')->name('login');
Route::post('/auth/register', 'RegisterController@register')->name('register');

Route::post('users', 'UserController@store')->name('users.store');

Route::middleware('apiJwt')->group(function(){
  Route::post('/auth/logout', 'AuthController@logout')->name('logout');
  Route::post('/refresh', 'AuthController@refresh')->name('refresh');
  Route::post('/me', 'AuthController@me')->name('me');

  Route::post('users/{company}', 'UserController@index')->name('users.index');
  Route::apiResource('/users', 'UserController')->except(['store', 'index']);
  Route::apiResources([
    '/company' => 'CompanyController',
    '/clients' => 'ClientController',
  ]);

  Route::get('/products/{company}/{category}', 'ProductController@index')->name('products.index');
  Route::apiResource('/products', 'ProductController')->except('index');
});
