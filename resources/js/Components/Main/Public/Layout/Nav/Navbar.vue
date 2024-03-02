<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const props = defineProps({
    animation: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <div class="fixed top-1 z-50 w-full flex justify-center mb-8 px-2 overflow-hidden">
        <nav :class="['w-full z-50 mt-1 max-w-[90rem] 2xl:max-w-[100rem] backdrop-blur-md rounded-3xl border border-[#000000]/[0.16]', { 'animate-fade-in-down': props.animation }]"
            style="animation-delay: 1.1s;">
            <div :class="['px-2 h-12 w-full']">
                <div :class="['w-full h-full flex items-center justify-between']">
                    <div class="flex items-center justify-start h-full">

                        <Link href="/" class="flex md:mr-24 gap-2">

                        <ApplicationLogo />

                        <span
                            class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-gray-200 text-gray-800">
                            MAET
                        </span>
                        </Link>
                    </div>

                    <div class="flex items-center space-x-3 divide-x divide-[#000000]/[0.16]">
                        <ul class="flex items-center space-x-6">
                            <li>
                                <Link href="/" class="font-semibold text-gray-800 hover:text-gray-500 dark:text-gray-200 transition duration-300">Home</Link>
                            </li>
                            <li>
                                <Link :href="route('jobs.index')" class="font-semibold text-gray-800 hover:text-gray-500 dark:text-gray-200 transition duration-300">Jobs</Link>
                            </li>
                            <li>
                                <Link href="/#about" class="font-semibold text-gray-800 hover:text-gray-500 dark:text-gray-200 transition duration-300">About me</Link>
                            </li>
                        </ul>
                        <div class="pl-3">
                            <slot name="button" />
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>