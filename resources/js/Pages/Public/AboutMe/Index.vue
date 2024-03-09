<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TimeContainer from '@/Components/Main/Public/Containers/TimeContainer.vue';
import SimpleContainer from '@/Components/Main/Public/Containers/SimpleContainer.vue';

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
            <!-- <meta head-key="description" type="description" name="description" :content="cleanString(job.preview)"> -->
        </Head>

        <div>
            <div class="bg-gradient-to-b from-indigo-700/10 to-indigo-700/5 w-full h-[15rem] rounded-xl shadow-sm">
                <div class="flex w-full h-full items-center px-4">
                    <div class="text-center sm:text-left w-full">
                        <h1 :class="`text-5xl lg:text-7xl md:text-6xl font-bold text-gray-800`">
                            About me
                        </h1>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row my-10 sm:mt-10 sm:mb-0 w-full h-full sm:gap-10">
                <div class="transform -translate-y-16 flex justify-center sm:-translate-y-16 sm:translate-x-4 shrink-0">
                    <img src="/img/others/retrato.jpg" alt=""
                        class="w-32 h-32 shrink-0 rounded-full object-cover ring-2 ring-offset-2 ring-indigo-700 shadow-xl">
                </div>

                <div class="w-full grid grid-cols-1 sm:grid-cols-2 justify-between space-y-5">
                    <div class="text-center sm:text-left">
                        <p class="text-xl font-semibold text-gray-800">
                            {{ user.name }}
                        </p>

                        <p class="text-gray-600 font-medium">
                            {{ user.position }}
                        </p>
                        <p class="text-center sm:text-left text-indigo-700">
                            <a :href="`mailto:${user.email}`">
                                <span class="flex justify-center sm:justify-start items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail"
                                        width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                        <path d="M3 7l9 6l9 -6" />
                                    </svg>
                                    {{ user.email }}
                                </span>
                            </a>
                        </p>
                    </div>

                    <div class="flex gap-3 justify-self-center sm:justify-self-end h-10 divide-x divide-[#000000]/[0.16]">
                        <template v-if="user.user_social_media">
                            <div class="flex gap-3">
                                <div v-for="( social_media, index ) in user.user_social_media" :key="'social-media-' + index" class="py-2">
                                    <div id="tech-container">
                                        <a :href="social_media.url" target="_blank">
                                            <span v-html="social_media.social_media.icon"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <a :href="`mailto:${user.email}`" class="pl-3">
                            <SecondaryButton :hidden="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 14l11 -11" />
                                    <path
                                        d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                </svg>
                            </SecondaryButton>
                        </a>
                    </div>
                </div>
            </div>

            <div class="space-y-10 divide-y divide-[#000000]/[0.16]">
                <div>
                    <h2 class="mb-10 text-3xl font-semibold text-gray-800">
                        About
                    </h2>

                    <div class="content-ckeditor">
                        <p v-html="user.bio" />
                    </div>
                </div>

                <div>
                    <h2 class="my-10 text-3xl font-semibold text-gray-800">
                        Knowledge
                    </h2>

                    <div class="overflow-x-auto">
                        <div class="grid grid-rows-8 sm:grid-rows-4 grid-flow-col gap-4">
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

                <div>
                    <h2 class="my-10 text-3xl font-semibold text-gray-800">
                        Experiences
                    </h2>

                    <TimeContainer :data="user.experiences" />
                </div>

                <div>
                    <h2 class="my-10 text-3xl font-semibold text-gray-800">
                        Education
                    </h2>

                    <TimeContainer :data="user.education" :grid="'grid-cols-1 sm:grid-cols-2'" />
                </div>
            </div>
        </div>
    </div>
</template>