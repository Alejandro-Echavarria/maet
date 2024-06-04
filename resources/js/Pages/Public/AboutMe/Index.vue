<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TimeContainer from '@/Components/Main/Public/Containers/TimeContainer.vue';
import cleanString from '@/Helpers/HelperFunctions';

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    user: {
        type: Object,
    }
});
</script>

<template>
    <div>

        <Head>
            <title>About me</title>
            <meta head-key="description" type="description" name="description" :content="cleanString(user.bio)">
        </Head>

        <div class="max-w-5xl mx-auto">
            <div class="relative w-full h-[9.5rem] rounded-xl overflow-hidden animate-fade-in"
                style="animation-delay: 0.1s; animation-duration: 0.4s;">
                <div
                    class="h-full bg-gray-800 border border-gray-600 rounded-xl overflow-hidden shadow-gray-500/50 shadow-lg">
                    <div class="border-b bg-gray-900 border-gray-600">
                        <div class="flex h-6 items-center gap-5 px-3">
                            <div class="flex items-center gap-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-red-400"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-yellow-400"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-400"></div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 h-8 text-sm text-gray-300">
                            <div class="flex items-center w-44 px-4 h-full border-b-2 border-indigo-700">
                                <code>
                                    ~/maet/about-me
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
                        <code class="flex text-gray-200 text-3xl lg:text-5xl font-semibold animate-fade-in-left">
                            <span class="text-gray-300">$&nbsp;</span>
                            <h1
                            style="animation-delay: 0.33s; animation-duration: 0.4s;">
                                About me
                            </h1>
                        </code>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row mt-10 mb-20 sm:mb-10 w-full h-full sm:gap-10">
                <div class="transform -translate-y-16 flex justify-center sm:-translate-y-16 sm:translate-x-4 shrink-0 animate-fade-in"
                    style="animation-delay: 0.56s;">
                    <img src="/img/others/retrato.jpg" alt="personal photo"
                        class="w-32 h-32 shrink-0 rounded-full object-cover ring-2 ring-offset-2 ring-indigo-700 shadow-xl">
                </div>

                <div class="w-full grid grid-cols-1 sm:grid-cols-2 justify-between space-y-5">
                    <div class="text-center sm:text-left">
                        <p class="text-xl font-semibold text-gray-800 animate-fade-in-up"
                            style="animation-delay: 0.66s;">
                            {{ user.name }}
                        </p>

                        <p class="text-gray-600 font-medium animate-fade-in-up" style="animation-delay: 0.76s;">
                            {{ user.position }}
                        </p>
                        <p class="flex justify-center sm:justify-start items-center gap-1 text-center sm:text-left text-indigo-700 animate-fade-in-up"
                            style="animation-delay: 0.86s;">
                            <a :href="`mailto:${user.email}`">
                                <span class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-mail shrink-0" width="20" height="20"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                        <path d="M3 7l9 6l9 -6" />
                                    </svg>
                                </span>
                            </a>
                            {{ user.email }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 justify-self-center sm:justify-self-end h-10">
                        <div class="flex justify-center sm:justify-end gap-4 divide-x divide-[#000000]/[0.16]">
                            <template v-if="user.platforms.length > 0">
                                <div class="flex gap-4">
                                    <div v-for="( platform_type, index ) in user.platforms"
                                        :key="'social-media-' + index" class="py-2 animate-fade-in-left"
                                        :style="{ animationDelay: `${index * 0.11}s` }">
                                        <div id="tech-container">
                                            <a :href="platform_type.url" target="_blank"
                                                :title="platform_type.platform_type.name"
                                                :aria-label="platform_type.platform_type.name">
                                                <span v-html="platform_type.platform_type.icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <div :class="[user.platforms.length > 0 && 'pl-4']" class="animate-fade-in-left"
                                style="animation-delay: 0.50s;">
                                <a :href="`mailto:${user.email}`">
                                    <SecondaryButton :hidden="false" title="Send me an email"
                                        aria-label="Send me an email">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-send" width="20" height="20"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14l11 -11" />
                                            <path
                                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                        </svg>
                                    </SecondaryButton>
                                </a>
                            </div>
                        </div>

                        <div class="flex justify-center sm:justify-end animate-fade-in-left"
                            style="animation-delay: 0.66s;">
                            <a href="/files/cv/cv.pdf" target="_blank">
                                <PrimaryButton>
                                    Dowmload my CV
                                </PrimaryButton>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-10 sm:space-y-20">
                <div>
                    <div class="content-ckeditor animate-fade-in" style="animation-delay: 0.96s;">
                        <p v-html="user.bio" />
                    </div>
                </div>

                <template v-if="user.knowledge.length > 0">
                    <div class="space-y-10 sm:space-y-20">
                        <h2 class="text-3xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200 animate-fade-in-up"
                            style="animation-delay: 1.1s;">
                            Knowledge
                        </h2>

                        <div class="">
                            <div class="grid grid-rows-1 sm:grid-rows-4 sm:grid-flow-col gap-4 animate-fade-in-up"
                                style="animation-delay: 1.16s;">
                                <div v-for="( record, index ) in user.knowledge" :key="'data-container-' + index">
                                    <div id="tech-container" class="flex gap-4">
                                        <div>
                                            <span class="w-5 h-5" v-html="record.icon"></span>
                                        </div>

                                        <div>
                                            <span>
                                                {{ record.name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>


                <template v-if="user.experiences.length > 0">
                    <div class="space-y-10 sm:space-y-20">
                        <h2 class="text-3xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200">
                            Experiences
                        </h2>

                        <TimeContainer :data="user.experiences" />
                    </div>
                </template>

                <template v-if="user.education.length > 0">
                    <div class="space-y-10 sm:space-y-20">
                        <h2 class="text-3xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200">
                            Education
                        </h2>

                        <TimeContainer :data="user.education" :grid="'grid-cols-1 sm:grid-cols-2'" />
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>