<x-layout title="Travel">
    <div class="flex min-h-[calc(100dvh-4rem)] flex-col">

        {{--        <section class="mx-auto w-full max-w-6xl shrink-0 px-6">--}}
        {{--            <header class="py-8 md:py-12">--}}
        {{--                <h1 class="text-3xl font-bold">Travel</h1>--}}

        {{--                <p class="mt-2 text-sm text-muted-foreground">--}}
        {{--                    Subtitle goes here.--}}
        {{--                </p>--}}
        {{--            </header>--}}
        {{--        </section>--}}

        <section
            id="webgl-container"
            class="relative min-h-80 flex-1 overflow-hidden"
        >
            <canvas
                id="webgl"
                class="absolute inset-0 block h-full w-full"
            ></canvas>
        </section>

    </div>
</x-layout>
