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
Route::post('/auth/logout', 'AuthController@logout')->name('logout');
Route::post('/refresh', 'AuthController@refresh')->name('refresh');
Route::post('/me', 'AuthController@me')->name('me');

Route::apiResources([
  '/company' => 'CompanyController',
  '/users' => 'UserController',
  '/categories' => 'CategoryController',
  '/clients' => 'ClientController',
  '/products' => 'ProductController',
]);
