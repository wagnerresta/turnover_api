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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    
});

Route::group([

    'middleware' => 'apiJwt:api',
    'prefix' => 'account'

], function ($router) {

    Route::post('deposit','\App\Http\Controllers\Deposits\DepositController@storeDeposit')->name('account.store.deposit');
    Route::post('buy','\App\Http\Controllers\Buys\BuysController@buyStore')->name('buy.store');
    Route::get('deposit/pending','\App\Http\Controllers\Deposits\DepositController@listPending')->name('deposit.pending');
    Route::post('deposit/alter/status','\App\Http\Controllers\Deposits\DepositController@alterStatusDeposit')->name('status.deposit');
    Route::get('deposit/list','\App\Http\Controllers\Deposits\DepositController@listLogBalance')->name('list.deposit');
    Route::get('deposit/details/{id}','\App\Http\Controllers\Deposits\DepositController@depositDetails')->name('deposit.details');
    Route::post('me', 'AuthController@me');

});


Route::post('account/new','\App\Http\Controllers\Users\UsersController@accountStore')->name('account.store');


