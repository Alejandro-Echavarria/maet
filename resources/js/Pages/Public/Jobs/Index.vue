<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import WebMockup from '@/Components/Main/Public/Components/Mockups/Webs/WebMockup.vue';
import Stacks from '@/Components/Main/Public/Containers/Stacks/Stacks.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Aside from '@/Components/Main/Public/Components/Nav/Aside.vue';
import Pagination from '@/Components/Main/Admin/Components/Paginations/Pagination.vue';

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    jobs: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    technologies: {
        type: Object,
    },
    filter: String,
    page: String
});

let order = false;
const sidebar = ref(null);

const changeOrder = () => {
    return order = !order;
}

const toggleSidebarVisibility = () => {
    sidebar.value.toggleSidebarVisibility();
}
</script>

<template>
    <div>

        <Head>
            <title>Jobs</title>
            <meta head-key="description" type="description" name="description"
                content="Explore my web development portfolio showcasing standout projects. Discover my expertise and skills in web software development">
        </Head>

        <div>
            <div class="max-w-5xl mx-auto flex items-center justify-between">
                <h1 :class="`text-5xl lg:text-7xl md:text-6xl font-bold text-gray-800`">
                    Jobs
                </h1>
                
                <div class="bg-gray-100  rounded-full w-auto h-auto text-gray-800 min-[1490px]:hidden">
                    <button @click="toggleSidebarVisibility" class="h-8 w-8 flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mt-10">
                <div class="flex">
                    <Aside ref="sidebar"
                        :items="{ 'Categories': { 'model': 'category', 'items': categories }, 'Technologies': { 'model': 'technology', 'items': technologies } }" />

                    <div class="max-w-5xl mx-auto">
                        <div v-for="( job, index ) in jobs.data" :class="[index < 2 && 'animate-fade-in-down']"
                            :style="{ animationDelay: `${index * 0.2}s` }" :key="'jobs-' + job.id"
                            class="grid grid-cols-1 md:grid-cols-2 mb-10 sm:mb-20 w-full gap-8">
                            <div :class="['w-full order-1', changeOrder() ? 'order-1' : 'sm:order-2', 'space-y-4']">
                                <div>
                                    <span class="block text-indigo-700 font-semibold">
                                        {{ job.category.name }}
                                    </span>
                                    <Link :href="route('jobs.show', job.slug)" target="_blank"
                                        rel="noreferrer noopener nofollow">
                                    <h2
                                        class="text-2xl font-bold text-gray-800 dark:text-gray-200 hover:text-indigo-700 mt-4">
                                        {{ job.title }}
                                    </h2>
                                    </Link>
                                </div>

                                <p class="text-gray-500 dark:text-gray-300 line-clamp-3" v-html="job.preview" />

                                <div class="hidden sm:block">
                                    <Link :href="route('jobs.show', job.slug)" target="_blank"
                                        rel="noreferrer noopener nofollow"
                                        class="sm:w-auto w-full inline-block mt-2 text-blue-500 underline hover:text-blue-400"
                                        :title="job.title">
                                    <PrimaryButton>
                                        Read more
                                    </PrimaryButton>
                                    </Link>
                                </div>
                            </div>

                            <div class="order-1">
                                <Link :href="route('jobs.show', job.slug)">
                                <div :class="['w-full justify-end']">
                                    <WebMockup>
                                        <template #link>
                                            {{ job.link }}
                                        </template>

                                        <template #image>
                                            <img loading="lazy" class="w-full aspect-video overflow-auto object-cover"
                                                :src="`/storage/${job?.images[0]?.url}`" :alt="job.alt_banner_image">
                                        </template>

                                        <template #stacks>
                                            <Stacks :stacks="job.technologies" :placement="'bottom-2'" />
                                        </template>
                                    </WebMockup>
                                </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto">
                <Pagination :pagination="jobs" />
            </div>
        </div>
    </div>
</template>
