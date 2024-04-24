<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    url: {
        type: String,
        required: true
    },
    modelBinding: {
        type: Number,
        required: true
    }
});

const url = ref(props.url);
const modelBinding = ref(props.modelBinding);
const data = ref('No data found');

onMounted(() => {
    getData();
});

const getData = () => {
    if (modelBinding.value) {
        data.value = 'Proccesing...';
        return axios.get(route(url.value, modelBinding.value)).then(response => {
            if (response.data.length > 0) {
                data.value = response;
            } else {
                data.value = "No data found";
            }
        });
    }
};
</script>

<template>
    <div class="flex flex-col gap-6">
        <div v-if="data?.data" v-for="(data, index) in data?.data" class="border rounded-lg overflow-hidden animate-fade-in" :key="data.id" :style="{ animationDelay: `${index * 0.1}s` }">
            <div class="w-full flex justify-between">
                <div class="flex flex-col space-y-1 p-4">
                    <p class="font-semibold">{{ data.title }}</p>

                    <span class="text-green-500">${{ data.price }}</span>
                </div>

                <div class="flex items-center font-semibold px-4">
                    <Link :href="route('admin.jobs.index', { search: data.title })" :title="'See project ' + data.title">
                        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-up w-5 h-5 text-indigo-700 hover:text-indigo-500 transition-all ease-linear duration-300"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6c-.09 .15 -.18 .295 -.27 .439" /><path d="M19 22v-6" /><path d="M22 19l-3 -3l-3 3" /></svg>
                    </Link>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="border rounded-lg p-4 animate-fade-in">
                <div class="w-full flex justify-between">
                    <div class="flex flex-col space-y-1">
                        <p class="font-semibold">{{ data }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>