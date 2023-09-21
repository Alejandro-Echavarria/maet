<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import SaveEducation from './Partials/SaveEducation.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    educations: {
        type: Object,
    },
    experiences: {
        type: Object,
    },
    jobs: {
        type: Object,
    },
    workingSkills: {
        type: Object,
    },
    knows: {
        type: Object,
    }
});
</script>

<template>
    <div>
        <Head title="Resume" />

        <MainTitle>
            Resume
        </MainTitle>

        <section id="educations">
            <SaveEducation :educations="educations" />
        </section>
    </div>
</template>