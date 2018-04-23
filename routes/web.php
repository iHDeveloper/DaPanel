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
Route::get("/", function(){return view("layout.app");});
Route::get("/{id}/login/{token?}", "PanelController@login")->name("panel.login");
Route::get("/{id}/open/{token?}", "PanelController@open")->name("panel.open");
Route::get("/{id}/@{page}/{token?}", "PanelController@page")->name("panel.page");
Route::get("/{id}/$@{route}/{token?}", "PanelController@route")->name("panel.route");
Route::post("/@{id}/@services/@nickname", "ServicesController@nickname")->name("service.nickname");
Route::get("oauth2/discord/{id?}", "OAuth2Controller@discord")->name("oauth2.discord");
Route::get("devices/auth", "DevicesController@auth");
Route::prefix("/@studio")->group(function(){
    Route::get("/", "StudioController@home");
    Route::get("/{id}/editor", "StudioController@editor");
    Route::get("/{id}/app", "StudioController@app");
});
Route::get("/{id}", "PanelController@panel")->name("panel.find");
