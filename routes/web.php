<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route ::get('/travel', function () {
    return view('travel');
});

Route::get('/projects', function (){
    return view('projects');
});

Route::get('/notes', function (){
    return view('notes');
});
