<script setup>
import { Link } from '@inertiajs/vue3';
import WebMockup from '@/Components/Main/Public/Components/Mockups/Webs/WebMockup.vue';
import Stacks from '@/Components/Main/Public/Containers/Stacks/Stacks.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import cleanString from "@/Helpers/HelperFunctions";

const props = defineProps({
    projects: Object,
});

let order = false;

const changeOrder = () => {
    return order = !order;
}
</script>

<template>
    <div v-for="( project, index ) in projects" :class="[index < 2 && 'animate-fade-in-down']"
        :style="{ animationDelay: `${index * 0.2}s` }" :key="'project-' + project.id"
        class="grid grid-cols-1 md:grid-cols-2 mb-10 sm:mb-20 w-full gap-10">
        <div :class="['w-full h-full order-1', changeOrder() ? 'order-1' : 'md:order-2', 'space-y-4']">
            <div>
                <Link :href="route('jobs.index', { 'category': project.category.slug })">
                <span class="text-sm py-1 px-2 text-indigo-700 border-2 border-indigo-700 font-medium rounded-full hover:bg-indigo-700/5 transition ease-in-out duration-300">
                    {{ project.category.name }}
                </span>
                </Link>
                <Link :href="route('jobs.show', project.slug)" target="_blank" rel="noreferrer noopener nofollow">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 hover:text-indigo-700 transition ease-in-out duration-300 mt-4">
                    {{ project.title }}
                </h2>
                </Link>
            </div>

            <p class="text-gray-500 dark:text-gray-300 line-clamp-3">
                {{ cleanString(project.preview) }}
            </p>

            <div>
                <time class="text-gray-500 text-sm font-medium">
                    {{ project.created_at }}
                </time>
            </div>
        </div>

        <div class="order-1">
            <Link :href="route('jobs.show', project.slug)">
            <div :class="['w-full justify-end']">
                <WebMockup>
                    <template #link>
                        {{ project.link }}
                    </template>

                    <template #image>
                        <img loading="lazy" class="w-full aspect-video overflow-auto object-cover"
                            :src="`/storage/${project?.images[0]?.url}`" :alt="project.alt_banner_image">
                    </template>

                    <template #stacks>
                        <Stacks :stacks="project.technologies" :placement="'bottom-2'" />
                    </template>
                </WebMockup>
            </div>
            </Link>
        </div>
    </div>
</template>