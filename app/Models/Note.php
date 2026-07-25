<?php

namespace App\Models;

use App\Enum\NoteStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    protected $casts = [
        'status' => NoteStatus::class,
    ];
}
