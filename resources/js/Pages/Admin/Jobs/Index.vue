<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';

defineOptions({
    layout: MainLayout
});
</script>

<template>
    <Head title="Jobs" />

    <div>
        <h3 class="text-3xl font-bold">
            Resize to change the mode
        </h3>
        <div>
            <pre>
                5
            </pre>
        </div>
    </div>
</template>