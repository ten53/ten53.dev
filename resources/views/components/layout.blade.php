@props([
    'title' => 'ten53'
])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ten53 | {{ $title }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="relative min-h-screen overflow-hidden bg-base-200">

    {{-- Decorative background --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-primary/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-secondary/10 blur-3xl"></div>

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

    {{ $slot }}

</div>

</body>
</html>
