<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.admin.home');
});

Route::get('/test', function () {});
