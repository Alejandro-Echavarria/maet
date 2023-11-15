<script setup>
import { ref, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import Education from "./Partials/Education.vue";
import Section from "@/Components/Main/Containers/Sections/Section.vue";

defineOptions({
    layout: MainLayout,
});

const tabs = ref([
    { id: "education", label: "Educations", selected: false },
    { id: "experience", label: "Experiences", selected: false },
]);

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
    },
});
</script>

<template>
    <div>
        <Head title="Resume" />

        <MainTitle> Resume </MainTitle>

        <Section :tabsOptions="tabs">
            <template #tabeducation>
                <Education :educations="educations" />
            </template>

            <template #tabexperience>
                hola
            </template>
        </Section>
    </div>
</template>
