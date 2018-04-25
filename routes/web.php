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

# Others
Route::get("/", function(){return view("layout.app");});
Route::get("devices/auth", "DevicesController@auth");
Route::any( '(.*)', function( $page ){
    dd($page);
});

# OAuth2
Route::get("oauth2/discord/{id?}", "OAuth2Controller@discord")->name("oauth2.discord");

# Services
Route::post("@{id}/@services/@nickname", "ServicesController@nickname")->name("service.nickname");

# Studio Group
Route::prefix("@studio")->group(function(){
    Route::get("/", "StudioController@home");
    Route::get("editor", "StudioController@editor");
    Route::get("{id}/editor", "StudioController@editor");
    Route::get("{id}/app", "StudioController@app");
});

# Panel Urls
Route::get("{id}", "PanelController@panel")->name("panel.find");
Route::get("{id}/login/{token?}", "PanelController@login")->name("panel.login");
Route::get("{id}/open/{token?}", "PanelController@open")->name("panel.open");
Route::get("{id}/@{page}/{token?}", "PanelController@page")->name("panel.page");
Route::get("{id}/$@{route}/{token?}", "PanelController@route")->name("panel.route");
