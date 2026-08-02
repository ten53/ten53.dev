<x-admin-layout title="Notes">
    <section class="mx-auto max-w-6xl px-6 ">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Notes</h1>
            <p class="text-muted-foreground text-sm mt-2">Subtitle goes here.</p>
        </header>

        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($notes as $note)
                    <x-card href="{{ route('admin.note.show', $note) }}">
                        <h3 class="text-foreground text-lg">{{ $note->title }}</h3>
                        <div class="mt-5 line-clamp-3">{{ $note->excerpt }}</div>
                        <p class="mt-4">{{ $note->published_at->format('F j, Y') }}</p>
                    </x-card>
                @empty
                    <x-card>
                        <p>No notes to show at this time.</p>
                    </x-card>
                @endforelse
            </div>
        </div>
    </section>
</x-admin-layout>

