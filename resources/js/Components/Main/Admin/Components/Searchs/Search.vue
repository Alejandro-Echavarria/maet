<!-- <script setup>
import { ref, onMounted, computed, defineProps } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import pickBy from 'lodash/pickBy';

const search = ref(props.filter);
const page = ref(usePage().props.current_page);

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
}

const contactsFilter = () => {
    router.get(route('admin.socialmedias.index'), pickBy({ search: search.value, page: page.value }), { preserveState: true });
}

const debounceData = computed(() => debounce(contactsFilter, 500));

onMounted(() => {
    debounceData.value(); // Llamamos a la función debounceData al montar el componente
});

const props = defineProps({
    filter: {
        type: Object,
    }
});
</script> -->

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import pickBy from 'lodash/pickBy';

const search = ref(props.filter.search);
const page = ref('');

const debounceData = computed(() => debounce(getData, 500));

onMounted(() => {
    debounceData.value = debounce(getData, 500);
});

watch(search, () => {
    debounceData.value();
});

const getData = () => {
    router.get(route(props.url), pickBy({ search: search.value, page: page.value }), { preserveState: false });
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

const props = defineProps({
    filter: {
        type: Object,
    },
    url: {
        type: String,
        required: true
    }
});
</script>

<template>
    <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <input v-model="search" type="text" id="simple-search"
            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search" required="">
    </div>
</template>