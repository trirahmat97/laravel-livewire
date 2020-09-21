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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->prefix('users')->group(function () {
    Route::livewire('', 'backend.users.index')->layout('layouts.backend', ['title' => 'Users'])->name('users');
});
Route::middleware('auth')->prefix('permissions')->group(function () {
    Route::livewire('roles', 'backend.permission.role')->layout('layouts.backend', ['title' => 'Roles'])->name('roles');
    Route::livewire('permissions', 'backend.permission.permission')->layout('layouts.backend', ['title' => 'Permissions'])->name('permissions');
});
