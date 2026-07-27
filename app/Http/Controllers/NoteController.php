<?php

namespace App\Http\Controllers;

use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        
        return view('notes', [
            'notes' => $notes,
        ]);
    }

    public function show(string $slug)
    {
        //
    }
}
