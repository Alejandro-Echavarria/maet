<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import WebMockup from '@/Components/Main/Public/Components/Mockups/Webs/WebMockup.vue';
import Stacks from '@/Components/Main/Public/Containers/Stacks/Stacks.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Main/Admin/Components/Paginations/Pagination.vue';

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    jobs: {
        type: Object,
    }
});

let order = false;

const changeOrder = () => {
    return order = !order;
}
</script>

<template>
    <div>

        <Head>
            <title>Jobs</title>
            <meta head-key="description" type="description" name="description" content="Explore my web development portfolio showcasing standout projects. Discover my expertise and skills in web software development">
        </Head>

        <div>
            <h1 :class="`text-5xl lg:text-7xl md:text-6xl font-bold text-gray-800`">
                Jobs
            </h1>

            <div>
                <div v-for="( job, index ) in jobs.data" :class="[ index < 2 && 'animate-fade-in-down']"
                    :style="{ animationDelay: `${index * 0.2}s` }" :key="'jobs-' + job.id"
                    class="grid grid-cols-1 md:grid-cols-2 mt-10 mb-10 sm:mb-20 w-full h-full gap-10">
                    <div :class="['w-full order-1', changeOrder() ? 'order-1' : 'sm:order-2', 'space-y-4']">
                        <div>
                            <span class="block text-indigo-700 font-semibold">
                                Personal project
                            </span>
                            <Link :href="route('jobs.show', job.slug)" target="_blank"
                                rel="noreferrer noopener nofollow">
                            <h2
                                class="block text-2xl font-bold text-gray-700 dark:text-gray-200 hover:text-indigo-700 pb-0">
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

            <Pagination :pagination="jobs" />
        </div>
    </div>
</template>
