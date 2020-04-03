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
    if(Auth::check()) {
        return redirect('grocery/list/1');
    }
    else {
        return redirect('login');
    }
});

Auth::routes(['register' => false]);

Route::get('/home', function(){
    return redirect('grocery/list/1');
})->name('home');

Route::prefix('grocery')->middleware(['auth'])->group(function () {
    Route::resources([
        'list' => 'Grocery\ListController',
        'item' => 'Grocery\ItemController',
        'category' => 'Grocery\CategoryController'
    ]);
    Route::get('/list/{list}/items', 'Grocery\ListItemController@items');
    Route::put('/list/{list}/item/{item}', 'Grocery\ListItemController@update');
    Route::delete('/list/{list}/item/{item}', 'Grocery\ListItemController@destroy');
});

Route::middleware(['auth'])->group(function() {
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('change-password', 'ProfileController@changePassword');
});
