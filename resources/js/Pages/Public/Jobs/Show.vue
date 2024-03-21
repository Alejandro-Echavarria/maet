<script setup>
import { onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Components/Main/Public/Layout/PublicLayout.vue';
import PrismjsHelper from "@/Helpers/Prismjs/Prismjs";
import cleanString from "@/Helpers/HelperFunctions";

defineOptions({
    layout: PublicLayout
});

const props = defineProps({
    job: {
        type: Object,
    }
});

onMounted(() => {
    PrismjsHelper();
});
</script>

<template>
    <div>

        <Head>
            <title>{{ job.title }}</title>
            <meta head-key="description" type="description" name="description" :content="cleanString(job.preview)">
        </Head>

        <div class="space-y-6 max-w-5xl mx-auto">
            <h1
                :class="`text-5xl lg:text-7xl py-1.5 md:text-6xl font-bold bg-gradient-to-r from-${job.color} via-indigo-700 to-blue-700 bg-clip-text text-transparent`">
                {{ job.title }}
            </h1>

            <div class="content-ckeditor mb-4">
                <p v-html="job.preview" />
            </div>

            <div class="rounded-xl overflow-hidden shadow-gray-500/20 shadow-lg sm:max-h-[40rem]">
                <div>
                    <div class="flex h-6 w-full items-center gap-5 bg-gray-800 px-3">
                        <div class="flex items-center gap-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-red-400"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-yellow-400"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-400"></div>
                        </div>
                        <div class="flex-1 pr-10 text-center text-[0.7rem] text-white leading-loose">
                            <p>
                                demo.link.com
                            </p>
                        </div>
                    </div>

                    <img fetchpriority="high" class="w-full aspect-video overflow-auto object-cover"
                        :title="job.alt_banner_image"
                        :src="`/storage/${job.images[0]?.url}`" :alt="job.alt_banner_image" />
                </div>
            </div>

            <div class="content-ckeditor mb-4">
                <p v-html="job.body" />
            </div>
        </div>
    </div>
</template>
