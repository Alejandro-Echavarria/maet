<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const projects = [
    {
        'name': 'Academic grade calculator - CI',
        'description': 'Academic grade calculator',
        'image': 'img/projects/ci.jpg',
        'link': 'https://ci.maet.dev/',
    },
    {
        'name': 'BLOG',
        'description': 'My personal blog',
        'image': 'img/projects/blog.jpg',
        'link': 'https://blog.maet.dev/',
    },
    {
        'name': 'PAYMENTS',
        'description': 'Payment gateway with stripe (Cashier)',
        'image': 'img/projects/payments.jpg',
        'link': 'https://payments.maet.dev/',
    },
];

const props = defineProps({
    user: Object,
    jobs: Object
});

const useAnimation = (index) => {
    return { 'animate-fade-in-up': index === 0 };
};

const user = props.user;
</script>

<template>
    <Head>
        <title>Manuel Echavarria</title>
        <meta name="description"
            content="Descubre maet.dev, mi portafolio de desarrollo web. Transforma tus ideas en sitios web impactantes y funcionales. ¡Impulsa tu presencia en línea con diseños modernos, responsivos y optimizados para SEO! Explora servicios de diseño y desarrollo web de calidad.">
        <meta name="keywords"
            content="desarrollo web, diseño web, diseño responsivo, Laravel, Vue, SEO, desarrollo frontend, desarrollo backend, maet.dev">
    </Head>

    <div>
        <Navbar :animation="true" />

        <MainBanner :user=user />

        <!-- <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-8 text-center animate-fade-in-up" style="animation-delay: 1.5s;">Projects</h3> -->
        <main class="xs:px-0 mx-4">
            <div class="max-w-5xl mx-auto">
                <div class="pb-10">
                    <div v-for="(job, index) in jobs" :key="'job-' + job.id" :style="{ animationDelay: `1.1s` }"
                        :class="['grid grid-cols-1 sm:grid-cols-2 mb-20 gap-8 w-full justify-between', useAnimation(index)]">
                        <div class="w-full order-2 sm:order-1">
                            <span class="block text-indigo-700 font-semibold">
                                Personal project
                            </span>
                            <Link :href="route('jobs.show', job.id)" target="_blank" rel="noreferrer noopener nofollow">
                            <h3 :class="['block mb-8 text-2xl font-bold text-gray-700 dark:text-gray-200 hover:text-indigo-700']">
                                {{ job.title }}
                            </h3>
                            </Link>

                            <p class="mb-8 text-sm text-gray-500 dark:text-gray-300 md:text-lg">
                                {{ job.projec_name }}
                            </p>

                            <div>
                                <Link :href="route('jobs.show', job.slug)" target="_blank" rel="noreferrer noopener nofollow"
                                    class="sm:w-auto w-full inline-block mt-2 text-blue-500 underline hover:text-blue-400">
                                    <PrimaryButton class="">
                                        Read more
                                    </PrimaryButton>
                                </Link>
                            </div>
                        </div>
                        <div class="w-full flex justify-end order-1 sm:order-2">
                            <img class="bg-auto sm:w-[20rem] md:w-[32rem] lg:w-[24rem] xl:w-[30rem] bg-no-repeat bg-center w-full rounded-2xl"
                                :src="`/storage/${job?.images[0]?.url}`"
                                :alt="job.alt_banner_image">
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <MainFooter />
    </div>
</template>
