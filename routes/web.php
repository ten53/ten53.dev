<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/travel', 'travel')->name('travel.index');
Route::view('/projects', 'projects')->name('projects.index');
Route::view('/notes', 'notes')->name('notes.index');
