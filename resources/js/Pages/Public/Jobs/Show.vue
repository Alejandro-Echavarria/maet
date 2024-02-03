<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    job: {
        type: Object,
    }
});
</script>

<template>
    <div>
        <Head>
            <title>{{ job.title }}</title>
            <meta name="description"
                :content="job.preview">
        </Head>

        <div class="space-y-6">
            <h1 :class="`text-5xl py-1.5 md:text-7xl font-bold animate-fade-in-left bg-gradient-to-r from-${job.color} via-indigo-700 to-blue-700 bg-clip-text text-transparent`"
                style="animation-delay: 0.1s; animation-duration: 0.4s;">
                {{ job.title }}
            </h1>

            <div class="content-ckeditor mb-4 animate-fade-in-right"
                style="animation-delay: 0.1s; animation-duration: 0.4s;">
                <p v-html="job.preview" />
            </div>

            <img class="h-96 w-full overflow-auto object-cover rounded-xl animate-fade-in"
                style="animation-delay: 0.66s; animation-duration: 0.6s;" :src="`/storage/${job?.images[0]?.url}`"
                :alt="job.alt_banner_image" />

            <div class="content-ckeditor mb-4 animate-fade-in-up" style="animation-delay: 1.1s;">
                <p v-html="job.body" />
            </div>
        </div>
    </div>
</template>