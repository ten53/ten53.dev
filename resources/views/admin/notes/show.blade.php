<x-admin-layout title="Notes">
    <section class="mx-auto max-w-6xl px-6">
        <header class="py-8 md:py-12">
            <a href="{{ route('admin.note.index') }}" class="cursor-pointer text-xs link-hover">
                ← Back to notes
            </a>

            <h1 class="text-3xl font-bold mt-2">Note {{ $note->id }}</h1>
        </header>

        <div>
            <x-card>
                <h1 class="font-bold text-4xl"> {{ $note->title }}</h1>

                <div class="mt-2 flex gap-x-3 items-center">
                    <div>{{ $note->status->label() }}</div>
                    <div class="text-muted-foreground text-sm">{{ $note->created_at->diffForHumans() }}</div>
                </div>

                <div class="text-foreground max-w-none mt-5">{{ $note->body }}</div>
            </x-card>

        </div>
    </section>
</x-admin-layout>
