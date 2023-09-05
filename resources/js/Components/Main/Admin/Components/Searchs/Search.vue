<script setup>
import { ref, onMounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import pickBy from 'lodash/pickBy';

const props = defineProps({
    filter: {
        type: String,
    },
    page: {
        type: Number,
    },
    url: {
        type: String,
        required: true
    }
});

const search = ref(props?.filter);
const page = ref('');

const debounceData = () => debounce(getData, 600);

onMounted(() => {
    debounceData.value = debounce(getData, 600);
});

watch(search, () => {
    debounceData.value();
});

const getData = () => {
    router.get(route(props.url), pickBy({ search: search.value, page: page.value }), {
        preserveScroll: true,
        preserveState: true,
        replace: true
    });
};

const debounce = (func, wait) => {
    let timeout;
    return function () {
        const context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            func.apply(context, args);
        }, wait);
    };
};
</script>

<template>
    <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <input v-model="search" type="text" id="simple-search"
            class="flex-1 w-full lock p-2 pl-7 py-2.5 px-0 text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition"
            placeholder="Search">
    </div>
</template>