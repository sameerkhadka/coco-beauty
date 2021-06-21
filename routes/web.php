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

$routes = ['services','members','appointments','birthdays','gift-vouchers','transactions','promotions','services','checkout'];

foreach($routes as $route){
    Route::get($route,function() use ($route){
        return view('pages.main',[
            'type' => $route
        ]);
    })->name($route);
}


