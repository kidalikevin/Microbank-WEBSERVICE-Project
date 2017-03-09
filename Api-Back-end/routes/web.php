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

Route::get('/', function () {
    return "Welcome To Micro Bank";
});

// Accessing controller functions
Route::resource('bank', 'BankController');

// Access account deduction function
Route::any('deduct/{id}', 'BankController@deduct');

// Trunacate table
Route::any('resetaccount', 'BankController@resetaccount');
