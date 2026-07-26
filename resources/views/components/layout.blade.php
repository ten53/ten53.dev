@props([
    'title' => null,
])

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        {{ $title ? "ten53 | {$title}" : 'ten53' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200 text-base-content antialiased">

<div class="relative min-h-screen overflow-hidden">

    {{-- Decorative background --}}
    <div
        class="pointer-events-none absolute inset-0 overflow-hidden"
        aria-hidden="true"
    >
        <div
            class="absolute -left-32 -top-32 h-96 w-96 rounded-full
                   bg-primary/10 blur-3xl"
        ></div>

        <div
            class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full
                   bg-secondary/10 blur-3xl"
        ></div>

        <div
            class="absolute inset-0 opacity-[0.04]"
            style="
                background-image:
                    linear-gradient(to right, currentColor 1px, transparent 1px),
                    linear-gradient(to bottom, currentColor 1px, transparent 1px);
                background-size: 40px 40px;
            "
        ></div>
    </div>

    <x-nav/>

    <main class="relative z-10">
        {{ $slot }}
    </main>

</div>

</body>
</html>
