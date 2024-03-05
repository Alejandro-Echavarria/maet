<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    aboutMe: {
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

        <div class="space-y-6">
            <h1
                :class="`text-5xl lg:text-7xl md:text-6xl font-bold text-gray-800`">
                About me
            </h1>
        </div>
    </div>
</template>