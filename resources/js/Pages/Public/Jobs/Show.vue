<script setup>
import { ref } from 'vue';
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
        <Head :title="job.title" />

        <!-- <div
            :class="`absolute top-0 left-0 z-[-2] h-[40vh] w-full bg-gradient-to-b from-${job.color} to-transparent rounded-b-[1.5rem]`">
        </div> -->

        <div class="space-y-6">
            <h1 :class="`text-3xl font-bold bg-gradient-to-r from-${job.color} via-indigo-700 to-blue-700 bg-clip-text text-transparent`">
                {{ job.title }}
            </h1>

            <div class="content-ckeditor mb-4">
                <p v-html="job.preview" />
            </div>

            <img class="h-96 w-full overflow-auto object-cover rounded-xl" :src="`/storage/${job?.images[0]?.url}`"
                :alt="job.alt_banner_image" />

            <div class="content-ckeditor mb-4">
                <p v-html="job.body" />
            </div>
        </div>
    </div>
</template>