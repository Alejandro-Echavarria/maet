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
            filter_value: value,
            filter: 'category',
        }
    });
};
</script>

<template>
    <aside class="col-span-1 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="h-full overflow-y-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Categories</h2>
            <ul class="my-4 space-y-2">
                <li @click="filter(item.slug)" v-for="item in items" :key="'category-' + item.id" class="hover:text-indigo-700 cursor-pointer">
                    {{ item.name }}
                </li>
            </ul>
        </div>
    </aside>
</template>