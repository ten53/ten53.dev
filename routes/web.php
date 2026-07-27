<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::view('/travel', 'travel')->name('travel.index');

Route::view('/projects', 'projects')->name('project.index');

Route::get('/notes', [NoteController::class, 'index'])->name('note.index');
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('note.show');
