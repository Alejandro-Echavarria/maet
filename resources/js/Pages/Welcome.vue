<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';

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

const user = props.user;
</script>

<template>
    <Head>
        <title>Home</title>
        <meta name="description"
            content="Descubre maet.dev, mi portafolio de desarrollo web. Transforma tus ideas en sitios web impactantes y funcionales. ¡Impulsa tu presencia en línea con diseños modernos, responsivos y optimizados para SEO! Explora servicios de diseño y desarrollo web de calidad.">
        <meta name="keywords"
            content="desarrollo web, diseño web, diseño responsivo, Laravel, Vue, SEO, desarrollo frontend, desarrollo backend, maet.dev">
    </Head>

    <div>
        <Navbar />
        <MainBanner :user=user />

        <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-8 text-center animate-fade-in-down" style="animation-delay: 0.2s;">Projects</h3>

        <main class="xs:px-0 mx-4">
            <div class="max-w-5xl mx-auto">
                <section>
                    <div class="pb-10">
                        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-10 xl:gap-16">
                            <div class="mt-8 lg:flex w-full justify-between animate-fade-in-down" v-for="(job, index) in jobs" :key="'job-' + job.id" :style="{ animationDelay: `${index * 0.1}s` }">
                                <div class="mt-6">
                                    <span class="text-indigo-700 font-semibold animate-fade-in" style="animation-delay: 0.2s;">
                                        Personal project
                                    </span>
                                    <Link :href="route('jobs.show', job.id)" target="_blank"
                                        rel="noreferrer noopener nofollow">
                                    <h3
                                        class="block mb-8 text-2xl font-bold animate-fade-in text-gray-700 dark:text-gray-200 hover:text-indigo-700" style="animation-delay: 0.2s;">
                                        {{ job.title }}
                                    </h3>
                                    </Link>

                                    <p class="mb-8 text-sm text-gray-500 dark:text-gray-300 md:text-lg">
                                        {{ job.projec_name }}
                                    </p>

                                    <Link :href="route('jobs.show', job.id)" target="_blank"
                                        rel="noreferrer noopener nofollow"
                                        class="inline-block mt-2 text-blue-500 underline hover:text-blue-400">
                                    Visit project
                                    </Link>
                                </div>
                                <img class="bg-auto sm:w-[20rem] md:w-[32rem] lg:w-[24rem] xl:w-[30rem] bg-no-repeat bg-center w-full rounded-xl animate-fade-in-down" style="animation-delay: 0.4s;"
                                    :src="`/storage/${job?.images[0]?.url}`" :alt="alt_banner_image">
                            </div>
                            
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</template>
