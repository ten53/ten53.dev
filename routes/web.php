<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Public\NoteController;
use Illuminate\Support\Facades\Route;

// Public
Route::view('/', 'index')->name('home');

Route::view('/travel', 'travel')->name('travel.index');

Route::view('/projects', 'projects')->name('project.index');

Route::get('/notes', [NoteController::class, 'index'])->name('note.index');

Route::get('/notes/{note}', [NoteController::class, 'show'])->name('note.show');

// Admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::view('/admin/home', 'admin.index')->name('admin.home');

    Route::view('/admin/travel', 'admin.travel')->name('admin.travel.index');

    Route::view('/admin/projects', 'admin.projects')->name('admin.project.index');

    Route::get('/admin/notes', [AdminNoteController::class, 'index'])->name('admin.note.index');

    Route::get('/admin/notes/{note}', [AdminNoteController::class, 'show'])->name('admin.note.show');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});

// Login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');

    Route::post('/login', [SessionController::class, 'store']);
});


