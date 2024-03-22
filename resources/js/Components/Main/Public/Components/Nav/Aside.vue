<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    items: Object,
    page: String
});

const filter = (value) => {
    router.visit(router.page.url, {
        preserveScroll: false,
        preserveState: true,
        data: {
            model: 'category',
            filter: value,
        }
    });
};
</script>

<template>
    <aside class="text-gray-800 dark:text-gray-200 border-r border-[#000000]/[0.16] dark:bg-gray-800 dark:border-gray-700">
        <div class="h-full overflow-y-auto">
            <h2 class="text-2xl font-bold">Categories</h2>
            <ul class="my-4 space-y-2">
                <li @click="filter(item.slug)" v-for="item in items" :key="'category-' + item.id" class="font-semibold hover:text-indigo-700 cursor-pointer">
                    {{ item.name }}
                </li>
            </ul>
        </div>
    </aside>
</template>