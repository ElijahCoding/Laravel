<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/auth/register/1', 'Auth\Register\RegisterControllerStep1@index');
// Route::get('/auth/register/2', 'Auth\Register\RegisterControllerStep2@index');
// Route::get('/auth/register/3', 'Auth\Register\RegisterControllerStep3@index');

Route::multistep('auth/register', 'Auth\Register\RegisterController')
     ->steps(3)
     ->name('auth.register');
