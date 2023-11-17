<script setup>
import { ref, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import Education from "@/Pages/Admin/Resume/Educations/Education.vue";
import Section from "@/Components/Main/Containers/Sections/Section.vue";
import Experience from "@/Pages/Admin/Resume/Experiences/Experience.vue";

defineOptions({
    layout: MainLayout,
});

const tabs = ref([
    { id: "education", label: "Educations", selected: false },
    { id: "experience", label: "Experiences", selected: false },
    { id: "job", label: "Jobs", selected: false },
    { id: "workingSkill", label: "Working Skills", selected: false },
    { id: "know", label: "Knows", selected: false },
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
                <Experience :experiences="experiences" />
            </template>

            <template #tabjob> hola </template>
        </Section>
    </div>
</template>
