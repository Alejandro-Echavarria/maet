<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import SaveAboutMe from '@/Pages/Admin/AboutMe/Partials/SaveAboutMe.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    auth: Object
});
</script>

<template>
    <Head>
        <title>About me</title>
    </Head>

    <div>
        <MainTitle>
            About me
        </MainTitle>

        <div class="flex w-auto mb-4">
            <Link :href="route('profile.show')">
            <p class="text-indigo-700 text-md hover:text-indigo-400 transition duration-300">
                Click to change your <span class="font-bold">email</span> and <span class="font-bold">name </span>
                <font-awesome-icon class="w-4 h-4 ml-1" :icon="['fas', 'user-pen']" />
            </p>
            </Link>
        </div>

        <SaveAboutMe :data="auth" />
    </div>
</template>
