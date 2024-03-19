<?php

use App\Http\Controllers\Backend\HomeController;

use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class) -> group(function(){
    Route::get('/','index');
});
Route::controller(RoomController::class)->group(function(){
    Route::get('room','index');
    Route::get('addnew','create');
    Route::post('room/save','save'); 
    //edit 
    Route::get('room/edit/{id}','edit') ->name('room.edit');
    Route::post('room/update','update'); 
    //delete 
    Route::get('room/delete/{id}','delete');
    //search
    Route::get('room/search','search');
});

//login
Route::controller(UserController::class) ->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/Dologin','dologin')->name('login.dologin');
});