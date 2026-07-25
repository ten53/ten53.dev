
<x-layout title='Welcome'>

<x-nav />

    {{-- Main content --}}
    <main class="relative z-10 mx-auto flex min-h-[calc(100vh-65px)] max-w-6xl items-center px-6 py-16">
        <section class="max-w-3xl">

{{--            <div class="mb-6 flex flex-wrap gap-2">--}}
{{--                <span class="badge badge-primary badge-outline">Laravel</span>--}}
{{--                <span class="badge badge-secondary badge-outline">Software</span>--}}
{{--                <span class="badge badge-accent badge-outline">Travel</span>--}}
{{--                <span class="badge badge-neutral badge-outline">Experiments</span>--}}
{{--            </div>--}}

            <p class="mb-4 font-mono text-sm font-semibold uppercase tracking-[0.25em] text-primary">
                Personal website of Kenneth Wright
            </p>

            <h1 class="max-w-2xl text-5xl font-bold leading-tight tracking-tight sm:text-6xl lg:text-7xl">
                Learning, building and documenting the journey.
            </h1>

            <p class="mt-6 max-w-2xl text-lg leading-8 text-base-content/70">
                I’m a lifelong learner exploring software engineering, AI,
                languages, travel, scuba diving, playing bass guitar, and whatever else
                catches my interest.
            </p>

            <div class="mt-10 flex flex-wrap gap-3">
                <a href="/travel" class="btn btn-primary">
                    Travel
                </a>

                <a
                    href="https://github.com/ten53"
                    class="btn btn-ghost"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    GitHub
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </a>
            </div>

            <div id="about" class="mt-14 border-l-2 border-primary pl-5">
                <p class="text-sm leading-6 text-base-content/60">
                    Built on a DigitalOcean droplet using Laravel, PHP, Linux,
                    Git, Nginx, and lot's of trial and error.
                </p>
            </div>

        </section>
    </main>

</x-layout>
