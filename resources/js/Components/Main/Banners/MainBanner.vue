<script setup>
import Container from '@/Components/Main/Containers/Container.vue';
import Stacks from "@/Components/Main/Public/Containers/Stacks/Stacks.vue";
import { Link } from '@inertiajs/vue3';

const { user } = defineProps({
    user: {
        type: Object,
    },
    knowledge: {
        type: Object,
    }
});
</script>

<template>
    <div class="w-full mt-12 h-[34rem] sm:h-[73vh] relative overflow-hidden">
        <div class="backdrop-blur-2xl bg-gradient-to-b from-white/80 to-blue-50/10 h-full">
            <Container class="h-full flex items-center">
                <div class="w-full flex flex-col text-center md:text-left">
                    <div>
                        <div>
                            <span
                                class="text-5xl lg:text-7xl font-bold bg-gradient-to-r from-gray-800 via-indigo-700 to-blue-700 bg-clip-text text-transparent">
                                Hey,
                            </span>
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-bold bg-gradient-to-r from-gray-800 via-indigo-700 to-blue-700 bg-clip-text text-transparent animate-fade-in-left"
                            style="animation-delay: 0.1s; animation-duration: 0.4s;">
                            <span>I'm</span> {{ user.name }}
                        </h1>
                    </div>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 mt-4 gap-4 animate-fade-in-up"
                        style="animation-delay: 0.66s;">
                        <div class="grid items-center my-4">
                            <div>
                                <Stacks :title="'Main Tech'" :stacks="knowledge" />
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="space-y-4">
                                <h2 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-800 dark:text-whit">
                                    {{ user.position }}
                                </h2>

                                <div class="bg-gray-800 border border-gray-600 rounded-xl overflow-hidden shadow-gray-500/50 shadow-lg">
                                    <div class="border-b bg-gray-900 border-gray-600">
                                        <div class="flex h-6 items-center gap-5 px-3">
                                            <div class="flex items-center gap-1">
                                                <div class="h-1.5 w-1.5 rounded-full bg-red-400"></div>
                                                <div class="h-1.5 w-1.5 rounded-full bg-yellow-400"></div>
                                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-400"></div>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 h-8 text-sm text-gray-300">
                                            <div
                                                class="flex items-center w-44 px-4 h-full border-b-2 border-indigo-700">
                                                <code>
                                                    ~/maet/life-goal
                                                </code>
                                            </div>

                                            <Link :href="route('aboutme.index')" title="My way">
                                                <div class="hover:animate-spin">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="w-5 h-5 icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 5l0 14" />
                                                        <path d="M5 12l14 0" />
                                                    </svg>
                                                </div>
                                            </Link>
                                        </div>
                                    </div>

                                    <div class="p-4 text-left">
                                        <code class="text-sm md:text-md font-medium text-gray-200">
                                            $ Passionate About Helping Others Succeed With Web Apps
                                        </code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Container>
        </div>
        <div class="w-32 sm:w-64 absolute top-10 right-20 z-[-1] animate-fade-in"
            style="fill: #6b56cb; animation-delay: 1.1s;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 747.2 726.7">
                <path
                    d="M539.8 137.6c98.3 69 183.5 124 203 198.4 19.3 74.4-27.1 168.2-93.8 245-66.8 76.8-153.8 136.6-254.2 144.9-100.6 8.2-214.7-35.1-292.7-122.5S-18.1 384.1 7.4 259.8C33 135.6 126.3 19 228.5 2.2c102.1-16.8 213.2 66.3 311.3 135.4z">
                </path>
            </svg>
        </div>
        <div class="w-12 absolute bottom-28 left-20 z-[-1] animate-fade-in"
            style="fill: #6b56cb; animation-delay: 1.1s;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 747.2 726.7">
                <path
                    d="M539.8 137.6c98.3 69 183.5 124 203 198.4 19.3 74.4-27.1 168.2-93.8 245-66.8 76.8-153.8 136.6-254.2 144.9-100.6 8.2-214.7-35.1-292.7-122.5S-18.1 384.1 7.4 259.8C33 135.6 126.3 19 228.5 2.2c102.1-16.8 213.2 66.3 311.3 135.4z">
                </path>
            </svg>
        </div>
    </div>
</template>
