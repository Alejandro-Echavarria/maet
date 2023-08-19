<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';

defineOptions({
    layout: MainLayout
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="pt-12">
        <h1 class="my-12 text-3xl font-bold leading-[1.2]">
            Resize to change the mode
        </h1>
        <div>
            <img class="inline-block w-[80%] rounded" src="https://tecdn.b-cdn.net/img/Photos/Others/img%20(53).webp" />
        </div>
    </div>
</template>