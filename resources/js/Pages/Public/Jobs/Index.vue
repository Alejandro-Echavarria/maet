<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import Aside from '@/Components/Main/Public/Components/Nav/Aside.vue';
import Pagination from '@/Components/Main/Admin/Components/Paginations/Pagination.vue';
import BetweenView from "@/Components/Main/Public/Components/OtherComponents/Pojects/BetweenView.vue";

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    jobs: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    technologies: {
        type: Object,
    },
    filter: String,
    page: String
});

const sidebar = ref(null);

const toggleSidebarVisibility = () => {
    sidebar.value.toggleSidebarVisibility();
}
</script>

<template>
    <div>

        <Head>
            <title>Projects</title>
            <meta head-key="description" type="description" name="description"
                content="Explore my web development portfolio showcasing standout projects. Discover my expertise and skills in web software development">
        </Head>

        <div>
            <div class="max-w-5xl mx-auto flex items-center justify-between">
                <h1 :class="`text-3xl lg:text-5xl font-semibold text-gray-800`">
                    Projects
                </h1>
                
                <div class="bg-gray-100  rounded-full w-auto h-auto text-gray-800 min-[1490px]:hidden">
                    <button @click="toggleSidebarVisibility" class="h-8 w-8 flex justify-center items-center" title="Filter" label="Filter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mt-10">
                <div class="flex">
                    <Aside ref="sidebar"
                        :items="{ 'Categories': { 'model': 'category', 'items': categories }, 'Technologies': { 'model': 'technology', 'items': technologies } }" />

                    <div class="max-w-5xl mx-auto">
                        <BetweenView :projects="jobs.data"/>
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto">
                <Pagination :pagination="jobs" />
            </div>
        </div>
    </div>
</template>
