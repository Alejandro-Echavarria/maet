<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import SaveJob from '@/Pages/Admin/Jobs/Partials/SaveJob.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    jobs: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    clients: {
        type: Object,
    },
    technologies: {
        type: Object
    }
});

const callOpenModal = ref(null);

const openModal = (op, id, titleData, start_date, end_date, description, color) => {
    callOpenModal.value.openModal(op, id, titleData, start_date, end_date, description, color);
};
</script>

<template>
    <div>

        <Head title="Jobs" />

        <MainTitle>
            Jobs
        </MainTitle>

        <SaveJob ref="callOpenModal" :data="{jobs, categories, clients, technologies}" />
    </div>
</template>