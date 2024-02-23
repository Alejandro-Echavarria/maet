<script setup>
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import SaveKnowledge from "@/Pages/Admin/Knowledge/Partials/SaveKnowledge.vue";
import DeleteKnowledge from "@/Pages/Admin/Knowledge/Partials/DeleteKnowledge.vue";
import SectionTabs from "@/Components/Main/Containers/Sections/SectionTabs.vue";
import TimeComponent from "@/Components/Main/Admin/Components/OtherComponents/Time.vue";

defineOptions({
    layout: MainLayout,
});

const props = defineProps({
    knowledge: {
        type: Object,
        required: true,
    },
});

const callOpenModal = ref(null);

const openModal = (op, id, name, icon, main) => {
    callOpenModal.value.openModal(op, id, name, icon, main);
};
</script>

<template>
    <div>

        <Head title="Knowledge" />

        <MainTitle> Knowledge </MainTitle>
        <SectionTabs>
            <template #tabknowledge>
                <SaveKnowledge ref="callOpenModal" :data="knowledge" />

                <TimeComponent>
                    <template #list>
                        <li class="mb-8 ml-4" v-for="knowledge in knowledge" :key="knowledge.id + '-knowledge'">
                            <div
                                class="absolute w-3 h-3 bg-indigo-100 rounded-full mt-1.5 -left-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700">
                            </div>
                            <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                <span>created at: </span> {{ knowledge.created_at }}
                            </time>
                            <div class="flex justify-between border-b border-dashed border-gray-200 mb-4">
                                <div class="flex gap-3 items-center">
                                    <span  id="tech-container" v-html="knowledge.icon"></span>
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white">
                                        {{ knowledge.name }}
                                    </h3>
                                </div>

                                <div class="flex gap-3">
                                    <button>
                                        <font-awesome-icon @click="
                                            openModal(
                                                2,
                                                knowledge.id,
                                                knowledge.name,
                                                knowledge.icon,
                                                knowledge.main
                                            )
                                            " class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                                    </button>
                                    <DeleteKnowledge :id="knowledge.id" :knowledge="knowledge"
                                        :key="knowledge.id + '-deleteBtn'" />
                                </div>
                            </div>
                            <p class="mb-4 dark:text-gray-400" v-html="knowledge.description" />
                        </li>
                    </template>
                </TimeComponent>
            </template>
        </SectionTabs>
</div></template>