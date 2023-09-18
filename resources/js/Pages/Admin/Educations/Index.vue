<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';

defineOptions({
    layout: MainLayout
});
</script>

<template>
    <div>
        <Head title="Educations" />

        <MainTitle>
            Educations
        </MainTitle>

        <div>
            <pre>
                5
            </pre>
        </div>
    </div>
</template>