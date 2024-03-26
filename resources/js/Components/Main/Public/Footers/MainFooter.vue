<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="mt-16 mx-4">
        <div class="max-w-5xl mx-auto h-auto py-4 border-t border-[#000000]/[0.16]">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <Link href="/" title="MAET" class="flex-shrink-0">
                    <div class="flex items-center h-auto w-full">
                        <div class="items-center">
                            <p class="font-bold dark:text-gray-200 text-gray-700">
                                <span>
                                    MAET / Portfolio
                                </span>
                            </p>
                        </div>
                    </div>
                    </Link>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-700 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-600 dark:text-gray-400 list-inside list-none">
                            <li class="mb-4">
                                <a href="https://blog.maet.dev/" class="hover:underline" target="_blank" title="Blog"
                                    rel="noreferrer noopener">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-700 uppercase dark:text-white">Follow me</h2>
                        <ul class="text-gray-600 dark:text-gray-400 list-inside list-none">
                            <li class="mb-4">
                                <a href="https://github.com/Alejandro-Echavarria" class="hover:underline" target="_blank" title="Github"
                                    rel="noreferrer noopener nofollow">Github</a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/mechavarria-maet/" class="hover:underline" title="Linkedin"
                                    target="_blank" rel="noreferrer noopener nofollow">Linkedin</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-700 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-600 dark:text-gray-400 list-inside list-none">
                            <li class="mb-4">
                                <a href="#" title="Privacy Policy" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" title="Terms &amp; Conditions" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <hr class="my-6 border-t sm:mx-auto border-[#000000]/[0.16] lg:my-8" /> -->
            <div class="my-6 lg:my-8 sm:flex sm:items-center sm:justify-between">
                <span class="text-sm font-semibold text-gray-500 sm:text-center dark:text-gray-400">©
                    {{ new Date().getFullYear() }}
                    <a href="/" class="hover:underline" title="MAET">
                        MAET DEV
                    </a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                    <a href="https://github.com/Alejandro-Echavarria"
                        class="text-gray-500 hover:text-gray-700 dark:hover:text-white" target="_blank"
                        rel="noreferrer noopener nofollow" title="Github">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="https://www.linkedin.com/in/mechavarria-maet/"
                        class="text-gray-500 hover:text-gray-700 dark:hover:text-white" target="_blank"
                        rel="noreferrer noopener nofollow" title="Linkedin">
                        <svg xmlns="https://www.w3.org/2000/svg" fill="currentColor" width="20" height="20"
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
</template>
