<?php

use App\Http\Controllers\LanguageController;

use Illuminate\Support\Facades\Route;
Route::get('/ajax/csrf/token36', function () {
    return csrf_token();
});


Route::group(['prefix' => '{language}'], function () {
    Route::get('/',function(){
        return view('frontend.pages.index');
    });
    Route::get('/about',function(){
        return view('frontend.pages.about');
    });
});

Route::get('/',function(){
    return view('frontend.pages.index');
});

