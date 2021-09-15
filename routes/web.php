<?php

use Illuminate\Support\Facades\Route;

/*
 * Все что угодно
 */
Route::get('/{any}', 'SpaController@index')->where('any', '.*');
