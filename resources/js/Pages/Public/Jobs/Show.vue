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
            <Link :href="route('jobs.index', { 'category': job.category.slug })" class="animate-fade-in-left"
                style="animation-delay: 0.36s;">
            <span class="py-1 px-2 text-sm text-indigo-700 font-medium border-2 border-indigo-700 rounded-full hover:bg-indigo-700/5 transition ease-in-out duration-300">
                {{ job.category.name }}
            </span>
            </Link>

            <h1 :class="`text-center text-5xl lg:text-7xl py-1.5 md:text-6xl font-bold bg-gradient-to-r from-${job.color} via-gray-800/90 to-gray-800 bg-clip-text text-transparent animate-fade-in-left`"
                style="animation-delay: 0.1s;">
                {{ job.title }}
            </h1>

            <div class="space-y-4">
                <div class="flex justify-center flex-wrap items-center gap-2">
                    <div v-if="job.link" class="flex flex-wrap items-center text-gray-600">
                        <a :href="job.link" target="_blank" rel="noreferrer noopener nofollow"
                            class="flex px-2  animate-fade-in-left" style="animation-delay: 0.46s;"
                            :title="job.title">
                            <span class="text-sm py-1 px-2 text-indigo-700 border-2 border-indigo-700 font-medium rounded-full hover:bg-indigo-700/5 transition ease-in-out duration-300">
                                Visit the project
                            </span>
                        </a>
                    </div>

                    <time class="animate-fade-in-left" style="animation-delay: 0.56s;">
                        <span class="font-medium text-sm text-gray-600">
                            {{ job.created_at }}
                        </span>
                    </time>
                </div>
            </div>

            <div class="flex justify-center flex-wrap gap-4 items-center text-gray-600">
                <div v-for="(technology, index) in job.technologies" :key="'technology-' + technology.id">
                    <Link :href="route('jobs.index', { 'technology': technology.slug })">
                    <div id="tech-container" class="flex gap-1 text-sm animate-fade-in-left"
                        :style="{ animationDelay: `${index * 0.11}s` }">
                        <span v-html="technology.icon" :title="technology.name"></span>
                        <!-- <p>
                            {{ technology.name }}
                        </p> -->
                    </div>
                    </Link>
                </div>
            </div>

            <div class="text-center content-ckeditor mb-4 animate-fade-in" style="animation-delay: 0.76s;">
                <p v-html="job.preview" />
            </div>

            <div class="rounded-xl overflow-hidden shadow-gray-500/20 shadow-lg sm:max-h-[40rem] animate-fade-in-up"
                style="animation-delay: 0.86s;">
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
