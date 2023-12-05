<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import SectionJobs from '@/Components/Main/Containers/Sections/SectionJobs.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    jobs: {
        type: Object,
    }
});
</script>

<template>
    <div>
        <Head title="Jobs" />

        <MainTitle>
            Jobs
        </MainTitle>

        <div>
            <SectionJobs :jobs="jobs" />
        </div>
    </div>
</template>