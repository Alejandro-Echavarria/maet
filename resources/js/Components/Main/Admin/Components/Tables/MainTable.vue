<script setup>
import Pagination from '@/Components/Main/Admin/Components/Paginations/Pagination.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';

const props = defineProps({
    pagination: {
        type: Object,
    },
    filter: {
        type: Object,
    },
    url: {
        type: String,
    }
});
</script>

<template>
    <div class="bg-white dark:bg-gray-800 relative border rounded-xl overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <Search :filter="filter" :url="url" />
            </div>
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end space-x-7 flex-shrink-0">
                <slot name="createButton" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs bg-gray-50 dark:bg-gray-700 text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <slot name="thead" />
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <TransitionGroup enter-active-class="ease-in-out duration-500"
                        enter-from-class="opacity-0 translate-x-4 sm:translate-x-0 sm:scale-95"
                        enter-to-class="opacity-100 translate-x-0 sm:scale-100" leave-active-class="ease-in duration-500"
                        leave-from-class="opacity-100 translate-x-0 sm:scale-100"
                        leave-to-class="opacity-0 translate-x-4 sm:translate-x-0 sm:scale-95"
                    >
                        <slot name="tbody" />
                    </TransitionGroup>
                </tbody>
            </table>
        </div>
        <template v-if="pagination">
            <Pagination :pagination="pagination" />
        </template>
    </div>
</template>