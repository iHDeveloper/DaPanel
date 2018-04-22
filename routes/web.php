<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(function(){
    Route::get('test', function(){
        return response()->json(["status"=>0]);
    });
    Route::prefix('panel')->group(function(){
        Route::get('info', function(){
            // TODO Info Route about the server name with id and clients
        });
    });
});