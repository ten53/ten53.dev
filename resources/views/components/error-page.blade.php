<x-layout :title="$title">
    <section class="mx-auto max-w-2xl px-6 py-24 text-center">
        <h1 class="text-5xl font-bold">{{ $code }}</h1>

        <h2 class="mt-4 text-2xl">{{ $title }}</h2>

        <p class="mt-4 text-base-content/70">
            {{ $message }}
        </p>

        <a href="{{ route('home') }}" class="btn btn-primary mt-8">
            Return Home
        </a>
    </section>
</x-layout>
