<script setup>
import { onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import PrismjsHelper from "@/Helpers/Prismjs/Prismjs";

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    job: {
        type: Object,
    }
});

onMounted(() => {
    PrismjsHelper();
});
</script>

<template>
    <div>

        <Head>
            <title>{{ job.title }}</title>
            <meta head-key="description" type="description" name="description" :content="job.project_name">
        </Head>

        <div class="space-y-6 max-w-5xl mx-auto">
            <Link :href="route('jobs.index', { 'category': job.category.slug })">
            <span class="py-1 px-2 text-sm text-indigo-700 font-semibold bg-indigo-700/10 rounded-full">
                {{ job.category.name }}
            </span>
            </Link>

            <h1
                :class="`text-5xl lg:text-7xl py-1.5 md:text-6xl font-bold bg-gradient-to-r from-${job.color} via-gray-800/90 to-gray-800 bg-clip-text text-transparent`">
                {{ job.title }}
            </h1>

            <div class="flex flex-wrap gap-4">
                <div v-for="technology in job.technologies" :key="'technology-' + technology.id">
                    <Link :href="route('jobs.index', { 'technology': technology.slug })">
                        <div id="tech-container"
                            class="flex gap-1 text-sm font-semibold rounded-full">
                            <span v-html="technology.icon"></span>
                            <p>
                                {{ technology.name }}
                            </p>
                        </div>
                    </Link>
                </div>
            </div>

            <div class="content-ckeditor mb-4">
                <p v-html="job.preview" />
            </div>

            <div class="rounded-xl overflow-hidden shadow-gray-500/20 shadow-lg sm:max-h-[40rem]">
                <div>
                    <div class="flex h-6 w-full items-center gap-5 bg-gray-800 px-3">
                        <div class="flex items-center gap-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-red-400"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-yellow-400"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-400"></div>
                        </div>
                        <div class="flex-1 pr-10 text-center text-[0.7rem] text-white leading-loose">
                            <a :href="job.link" target="_blank" rel="noreferrer noopener nofollow" :title="job.title">
                                {{ job.link }}
                            </a>
                        </div>
                    </div>

                    <img fetchpriority="high" class="w-full aspect-video overflow-auto object-cover"
                        :title="job.alt_banner_image" :src="`/storage/${job.images[0]?.url}`"
                        :alt="job.alt_banner_image" />
                </div>
            </div>

            <div class="content-ckeditor mb-4">
                <p v-html="job.body" />
            </div>
        </div>
    </div>
</template>
