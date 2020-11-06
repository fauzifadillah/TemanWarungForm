<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'DataController@index')->name('data.index');
Route::post('/', 'DataController@store')->name('data.store');

Route::middleware('auth')->group(function(){
	Route::prefix('dashboard')->group(function(){
		Route::get('/', 'DataController@dashboard')->name('data.dashboard');
		Route::prefix('data')->group(function(){
			Route::get('edit/{id}', 'DataController@edit')->name('data.edit');
			Route::put('update/{id}', 'DataController@update')->name('data.update');
			Route::delete('delete/{id}', 'DataController@delete')->name('data.delete');
			Route::get('datatable', 'DataController@datatable')->name('data.dt');
		});
	});
});