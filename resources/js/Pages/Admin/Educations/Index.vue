<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import Education from "@/Pages/Admin/Educations/Partials/Education.vue";
import SectionTabs from "@/Components/Main/Containers/Sections/SectionTabs.vue";

defineOptions({
    layout: MainLayout,
});

const props = defineProps({
    educations: {
        type: Object,
    }
});
</script>

<template>
    <div>
        <Head title="Educations" />

        <MainTitle> Educations </MainTitle>

        <SectionTabs>
            <template #tabeducation>
                <Education :educations="educations" />
            </template>
        </SectionTabs>
    </div>
</template>
