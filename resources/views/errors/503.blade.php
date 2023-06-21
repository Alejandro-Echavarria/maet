@php
    $projects = [
        [
            'name' => 'CI',
            'description' => 'Academic grade calculator',
            'image' => 'img/projects/ci.jpg',
            'link' => 'https://ci.maet.dev/',
        ],
        [
            'name' => 'BLOG',
            'description' => 'My personal blog',
            'image' => 'img/projects/blog.jpg',
            'link' => 'https://blog.maet.dev/',
        ],
        [
            'name' => 'PAYMENTS',
            'description' => 'Payment gateway with stripe (Cashier)',
            'image' => 'img/projects/payments.jpg',
            'link' => 'https://payments.maet.dev/',
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Manuel Echavarria">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description"
        content="maet.dev - Explora mi portafolio de desarrollo web. Convierte tus ideas en realida e impulsa tu presencia en línea con diseños responsivos y optimizados." />

    <link rel="shortcut icon" href="{{ asset('img/icon/11.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Tailwind --}}
    @vite(['resources/css/app.css'])

    <style>
        .banner {
            background-image: radial-gradient(#f3f3f3 1px, transparent 2px);
            background-size: 16px 16px;
        }
    </style>
</head>

<body class="font-sans antialiase banner">
    <nav class="bg-white/0 navSticky z-50 sticky top-0" x-data="{ open: false }">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-6 xl:px-8 2xl:px-16">
            <div class="flex items-center h-16">
                {{-- logotipo --}}
                <a href="/" class="flex-shrink-0">
                    <div class="flex items-center">
                        <div class="items-center">
                            <p class="font-extrabold text-gray-700"><span class="h-12 w-12">MAET</span></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-4 px-4 sm:px-0 lg:px-6">
                <div class="grid">
                    <div class="text-center">
                        <svg class="mx-auto mb-4 w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M331.8 224.1c28.29 0 54.88 10.99 74.86 30.97l19.59 19.59c40.01-17.74 71.25-53.3 81.62-96.65c5.725-23.92 5.34-47.08 .2148-68.4c-2.613-10.88-16.43-14.51-24.34-6.604l-68.9 68.9h-75.6V97.2l68.9-68.9c7.912-7.912 4.275-21.73-6.604-24.34c-21.32-5.125-44.48-5.51-68.4 .2148c-55.3 13.23-98.39 60.22-107.2 116.4C224.5 128.9 224.2 137 224.3 145l82.78 82.86C315.2 225.1 323.5 224.1 331.8 224.1zM384 278.6c-23.16-23.16-57.57-27.57-85.39-13.9L191.1 158L191.1 95.99l-127.1-95.99L0 63.1l96 127.1l62.04 .0077l106.7 106.6c-13.67 27.82-9.251 62.23 13.91 85.39l117 117.1c14.62 14.5 38.21 14.5 52.71-.0016l52.75-52.75c14.5-14.5 14.5-38.08-.0016-52.71L384 278.6zM227.9 307L168.7 247.9l-148.9 148.9c-26.37 26.37-26.37 69.08 0 95.45C32.96 505.4 50.21 512 67.5 512s34.54-6.592 47.72-19.78l119.1-119.1C225.5 352.3 222.6 329.4 227.9 307zM64 472c-13.25 0-24-10.75-24-24c0-13.26 10.75-24 24-24S88 434.7 88 448C88 461.3 77.25 472 64 472z" />
                        </svg>
                        <h1 class="mt-4 text-3xl font-bold text-gray-700 sm:text-5xl">MAET DEV - PORTAFOLIO</h1>
                        <div>
                            <span class="text-xl font-bold text-gray-700">Working in process</span>
                        </div>
                        <a href="mailto:mechavarria@maet.dev">
                            <button
                                class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 mt-8 rounded-xl">
                                Contact
                            </button>
                        </a>
                    </div>

                    {{-- Projects --}}
                    <section>
                        <div class="py-10">
                            <h3 class="text-xl font-semibold text-center text-gray-700 lg:text-2xl">
                                Estos son algunos de mi de proyectos
                            </h3>
                            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-10 xl:gap-16 lg:grid-cols-2 sm:place-items-center">
                                @foreach ($projects as $project)
                                    <div class="mt-8 lg:-mx-6 lg:flex lg:items-center sm:w-[20rem] md:w-[32rem] lg:w-[24rem] xl:w-[30rem]">
                                        <img class="bg-auto bg-no-repeat bg-center w-full"
                                            src="{{ asset($project['image']) }}"alt="">
                                        <div class="mt-6 lg:mt-0 lg:ml-2">
                                            <a
                                                href="{{ $project['link'] }}" target="_blank"
                                                rel="noreferrer noopener nofollow"
                                                class="block mt-4 text-2xl font-semibold text-gray-800 hover:underline dark:text-white">
                                                {{ $project['name'] }}
                                            </a>

                                            <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                                                {{ $project['description'] }}
                                            </p>

                                            <a href="{{ $project['link'] }}" target="_blank"
                                                rel="noreferrer noopener nofollow"
                                                class="inline-block mt-2 text-blue-500 underline hover:text-blue-400">
                                                Visit project
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 backdrop-blur-md bg-white/80 dark:bg-transparent border-t-2 dark:border-gray-600">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-6 xl:px-8 2xl:px-16">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/" class="flex-shrink-0">
                        <div class="flex items-center">
                            <div class="items-center">
                                <p class="font-extrabold dark:text-gray-200 text-gray-700">
                                    <span class="h-12 w-12">
                                        MAET
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-700 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-600 dark:text-gray-400 list-inside list-none">
                            <li class="mb-4">
                                <a href="https://blog.maet.dev/" class="hover:underline" target="_blank"
                                    rel="noreferrer noopener">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-700 uppercase dark:text-white">Follow me</h2>
                        <ul class="text-gray-600 dark:text-gray-400 list-inside list-none">
                            <li class="mb-4">
                                <a href="https://github.com/Alejandro-Echavarria" class="hover:underline"
                                    target="_blank" rel="noreferrer noopener nofollow">Github</a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/manuel-alejandro-echavarria-taveras-7587b518b/"
                                    class="hover:underline" target="_blank"
                                    rel="noreferrer noopener nofollow">Linkedin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-t-2 sm:mx-auto dark:border-gray-600 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm font-semibold text-gray-500 sm:text-center dark:text-gray-400">©
                    {{-- {{ new Date().getFullYear() }} --}}
                    <a href="#" class="hover:underline">
                        MAET
                    </a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">

                    <a href="https://github.com/Alejandro-Echavarria"
                        class="text-gray-500 hover:text-gray-700 dark:hover:text-white" target="_blank"
                        rel="noreferrer noopener nofollow">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="https://www.linkedin.com/in/manuel-alejandro-echavarria-taveras-7587b518b/"
                        class="text-gray-500 hover:text-gray-700 dark:hover:text-white" target="_blank"
                        rel="noreferrer noopener nofollow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20"
                            viewBox="0 0 24 24">
                            <path
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                        <span class="sr-only">Linkedin account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
