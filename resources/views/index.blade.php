<x-layout title="Welcome">

    <section class="mx-auto flex min-h-[calc(100vh-65px)] max-w-6xl items-center px-6 py-16">
        <div class="max-w-3xl">

            <p class="mb-4 font-mono text-sm font-semibold uppercase tracking-[0.25em] text-primary">
                Personal website of Kenneth Wright
            </p>

            <h1 class="max-w-2xl text-5xl font-bold leading-tight tracking-tight sm:text-6xl lg:text-7xl">
                Learning, building, and documenting the journey.
            </h1>

            <p class="mt-6 max-w-2xl text-lg leading-8 text-base-content/70">
                I’m a lifelong learner exploring software engineering, AI,
                languages, travel, scuba diving, playing bass, and whatever else
                catches my interest.
            </p>

            <div class="mt-10 flex flex-wrap gap-3">
                <a href="{{ route('travel.index') }}" class="btn btn-primary">
                    Explore travel
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
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </a>
            </div>

            <div class="mt-14 border-l-2 border-primary pl-5">
                <p class="text-sm leading-6 text-base-content/60">
                    Built on a DigitalOcean droplet using Laravel, PHP, Linux,
                    Git, Nginx, and lots of trial and error.
                </p>
            </div>

        </div>
    </section>

</x-layout>
