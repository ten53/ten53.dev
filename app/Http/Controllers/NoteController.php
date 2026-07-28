<?php

namespace App\Http\Controllers;

use App\Enum\NoteStatus;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        // return only published notes
        $notes = Note::published()
            ->latest('published_at')
            ->get();

        return view('notes', [
            'notes' => $notes,
        ]);
    }

    public function show(Note $note)
    {
        abort_if($note->status !== NoteStatus::PUBLISHED, 404);

        return view('note', [
            'note' => $note,
        ]);
    }
}
