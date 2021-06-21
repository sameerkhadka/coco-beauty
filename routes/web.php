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

$routes = ['services','members','appointments','birthdays','gift-vouchers','transactions','promotions'];

foreach($routes as $route){
    Route::get($route,function() use ($route){
        return view('pages.main',[
            'type' => $route
        ]);
    })->name($route);
}

Route::get('admin/services',function(){
    return view('pages.main',[
        'type'=>'crud-services'
    ]);
})->name('crud.services');

Route::get('admin/items',function(){
    return view('pages.main',[
        'type'=>'crud-items'
    ]);
})->name('crud.items');


