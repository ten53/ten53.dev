<?php

namespace Tests\Feature;

use App\Enum\NoteStatus;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_notes_page_only_receives_published_notes(): void
    {
        $publishedNote = Note::factory()->published()->create();
        Note::factory()->draft()->create();

        $response = $this->get(route('note.index'));

        $response
            ->assertOk()
            ->assertViewIs('notes')
            ->assertViewHas('notes', function ($notes) use ($publishedNote) {
                return $notes->count() === 1
                    && $notes->first()->is($publishedNote);
            });
    }

    public function test_public_user_can_view_a_published_note(): void
    {
        $note = Note::factory()->published()->create();

        $response = $this->get(route('note.show', $note));

        $response
            ->assertOk()
            ->assertViewIs('note')
            ->assertViewHas('note', fn($viewNote) => $viewNote->is($note));
    }

    public function test_public_user_cannot_view_a_draft_note(): void
    {
        $note = Note::factory()->draft()->create();

        $response = $this->get(route('note.show', $note));

        $response->assertNotFound();
    }

    public function test_admin_notes_page_receives_published_and_draft_notes(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        Note::factory()->published()->create();
        Note::factory()->draft()->create();

        $response = $this
            ->actingAs($admin)
            ->get(route('admin.note.index'));

        $response
            ->assertOk()
            ->assertViewHas('notes', function ($notes) {
                return $notes->count() === 2
                    && $notes->contains('status', NoteStatus::PUBLISHED)
                    && $notes->contains('status', NoteStatus::DRAFT);
            });
    }

    public function test_notes_page_handles_an_empty_database(): void
    {
        $response = $this->get(route('note.index'));

        $response
            ->assertOk()
            ->assertViewHas('notes', fn($notes) => $notes->isEmpty());
    }
}
