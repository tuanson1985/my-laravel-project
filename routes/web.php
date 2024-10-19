<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{language}'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
});
