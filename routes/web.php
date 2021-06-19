<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/members',function(){
    return view('pages.main',[
        'type' => 'members'
    ]);
})->name('members');

Route::get('/appointments',function(){
    return view('pages.main',[
        'type'=>'appointments'
    ]);
})->name('appointments');
