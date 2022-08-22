<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('guests.home');
// })->name('home');

Auth::routes(); // login, password, logout, register; queste rotte son gestite da Auth (crea 11 rotte; funzione come resource che ne crea 7 pero)

// Route::get('/admin', 'HomeController@index')->name('admin');
// Route::resource('posts', 'Admin\PostController');  // post è il nome della tabella del database, nonche nome del percorso

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')  // prefisso nel path http://127.0.0.1:8000/ + quello indicato in prefix(), ovvero http://127.0.0.1:8000/admin/
    ->group(function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');    // è come se scrivessi name('admin.dashboard');   --- admin. lo trovo in ->name()
        Route::resource('posts', 'PostController');  // tutti i controlli che si trovano in PostController si trovano sotto la cartella Admin; il nome viene indicato in ->namespace('Admin')
        Route::get('users', 'UserController@index')->name('users.index');   // ho definito solo una rotta che ci è data dalla funzione index() in UserController.php; utilizzo il get e non il resource perche non me ne servono 7 (rotte)
        Route::resource('categories', 'CategoryController');
    });
// con questo codice definisco i prefissi


Route::get("{any?}", function () {
    return view('guests.home');
})->where("any", ".*")->name('home'); // ".*" : rotta che prende tutto
