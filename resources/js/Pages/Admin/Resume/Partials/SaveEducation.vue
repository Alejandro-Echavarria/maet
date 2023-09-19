<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    educations: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div>
        <div class="flex my-3 justify-between">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Educations</h3>
            <PrimaryButton>
                Add education
            </PrimaryButton>
        </div>

        <ol class="relative border-l border-gray-200 dark:border-indigo-700">
            <li v-for="education in educations" :key="education.id + '-education'" class="mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-indigo-100 rounded-full mt-1.5 -left-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700">
                </div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                    {{ education.start_date }} - {{ education.end_date }}
                </time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ education.title }}
                </h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                    {{ education.description }}
                </p>
            </li>
        </ol>
    </div>
</template>