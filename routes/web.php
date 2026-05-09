<?php

use Illuminate\Support\Facades\Route;

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran.index');

Route::get('/', function () {
    return view('welcome');
})->name('landing.index');