<script setup>
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import SaveExperience from "@/Pages/Admin/Experiences/Partials/SaveExperience.vue";
import DeleteExperience from "@/Pages/Admin/Experiences/Partials/DeleteExperience.vue";
import SectionTabs from "@/Components/Main/Containers/Sections/SectionTabs.vue";
import Time from "@/Components/Main/Admin/Components/OtherComponents/Time.vue";

defineOptions({
    layout: MainLayout,
});

const props = defineProps({
    experiences: {
        type: Object,
        required: true,
    },
});

const callOpenModal = ref(null);

const openModal = (op, id, titleData, start_date, end_date, description, color) => {
    callOpenModal.value.openModal(op, id, titleData, start_date, end_date, description, color);
};
</script>

<template>
    <div>
        <Head title="Experieces" />

        <MainTitle> Experiences </MainTitle>

        <SectionTabs>
            <template #tabexperience>
                <SaveExperience ref="callOpenModal" :data="experiences" />

                <Time>
                    <template #list>
                        <li class="mb-8 ml-4" v-for="experience in experiences" :key="experience.id + '-experience'">
                            <div
                                class="absolute w-3 h-3 bg-indigo-100 rounded-full mt-1.5 -left-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700" />
                            <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                {{ experience.start_date }} - {{ experience.end_date }}
                            </time>
                            <div class="flex justify-between border-b border-dashed border-gray-200 mb-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-white">
                                    {{ experience.title }}
                                </h3>

                                <div class="flex gap-3">
                                    <button>
                                        <font-awesome-icon @click="openModal(
                                                2,
                                                experience.id,
                                                experience.title,
                                                experience.start_date,
                                                experience.end_date,
                                                experience.description,
                                                experience.color
                                            )"
                                            class="w-4 h-4 text-indigo-500"
                                            :icon="['far', 'pen-to-square']" />
                                    </button>
                                    <DeleteExperience :id="experience.id" :experience="experience" :key="experience.id + '-deleteBtn'" />
                                </div>

                            </div>
                            <p class="mb-4 dark:text-gray-400"
                                v-html="experience.description" />
                        </li>
                    </template>
                </Time>
            </template>
        </SectionTabs>
    </div>
</template>
