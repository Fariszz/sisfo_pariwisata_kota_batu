<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleMapController;


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
    return view('pages.welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('google-map')->group(function () {
    Route::get('/',[GoogleMapController::class,'index'])->name('google.map.index');
    Route::post('/post',[GoogleMapController::class,'store'])->name('google.map.store');
    Route::get('/detail',[GoogleMapController::class, 'show'])->name('google.map.show');
});

// Route::prefix('google-map')->group(function () {
//     Route::get('/','GoogleMapController@index')->name('google.map.index');
//     Route::post('/post','GoogleMapController@store')->name('google.map.store');
// });
