<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});
</script>

<template>

    <Head title="Dashboard" />

    <MainTitle>
        Dashboard
    </MainTitle>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div v-for="( element, index ) in data" :key="'card-' + index"
            class="rounded-xl border border-[#000000]/[0.16] overflow-hidden animate-fade-in-down"
            :style="{ animationDelay: `${index * 0.1}s` }">

            <div class="flex content-center h-full">
                <div class="p-4 col-span-2 text-gray-800 font-semibold flex items-center grow">
                    {{ element.label }}

                    <Link v-if="element.route" :href="element.route && route(element.route)" :title="'See more about ' + element.label">
                    <div class="ml-2 text-indigo-700 hover:scale-125 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m12 16l4-4l-4-4l-1.4 1.4l1.6 1.6H8v2h4.2l-1.6 1.6zm0 6q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                        </svg>
                    </div>
                    </Link>
                </div>

                <div
                    class="w-1/3 col-span-1 text-2xl font-medium text-indigo-700 flex items-center justify-center bg-indigo-700/10">
                    <span>
                        {{ element.total }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>