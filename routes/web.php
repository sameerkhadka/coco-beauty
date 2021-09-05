<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
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


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('index');
    $routes = ['services','members','appointments','birthdays','gift-vouchers','transactions','promotions','checkout','member-detail','transaction-detail'];

    foreach($routes as $route){
        Route::get($route,function() use ($route){
            return view('pages.main',[
                'type' => $route
            ]);
        })->name($route);
    }

    //admin routes
    Route::get("admin/settings",function() use ($route){
        return view('pages.main',[
            'type' => "settings"
        ]);
    })->name("settings");

    $routes = ['services','items','bandi-colour-gel','opi-gel-and-normal'];

    foreach($routes as $route){
        Route::get("admin/{$route}",function() use ($route){
            return view('pages.main',[
                'type' => "crud-{$route}"
            ]);
        })->name("crud.{$route}");
    }
    Route::post('change-password',[AuthController::class,'changePassword'])->name('changePassword');
});

//Route::get('/login', function () {
//    return view('login');
//})->name('login');

Route::get('/sendmail',[EmailController::class,'email']);
//livewire normal routes





