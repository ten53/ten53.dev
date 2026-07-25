<?php

namespace App\Enum;

enum NoteStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public function label(): string {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
        };
    }
}
