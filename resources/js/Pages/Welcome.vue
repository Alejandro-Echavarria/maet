<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import Container from '@/Components/Main/Containers/Container.vue';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';

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
    user: Object
});

const user = props.user;

const contactInfo = computed(() => {
    return {
        data: [
            {
                id: 1,
                title: 'Teléfono',
                value: user.phone,
                icon: 'mobile',
                color: 'text-gray-700',
            },
            {
                id: 2,
                title: 'Email',
                value: user.email,
                icon: 'envelope-circle-check',
                color: 'text-gray-700',
            },
            {
                id: 3,
                title: 'Dirección',
                value: user.address,
                icon: 'street-view',
                color: 'text-gray-700'
            },
            {
                id: 4,
                title: 'Año de nacimiento',
                value: user.birthday,
                icon: 'calendar',
                color: 'text-gray-700',
            }
        ],
    };
});
</script>

<template>
    <Head>
        <title>Home</title>
        <meta name="description" content="maet.dev - Explora mi portafolio de desarrollo web. Convierte tus ideas en realida e impulsa tu presencia en línea con diseños responsivos y optimizados.">
    </Head>

    <MainBanner :user=user />

    <Container>
        <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-200 mb-8 text-center">Some of my projects</h3>
        <!-- <SliderProjects /> -->

        <section>
            <div class="pb-10">
                <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-10 xl:gap-16">
                    <template v-for="project in projects">
                        <div class="mt-8 lg:flex w-full justify-between">
                            <div class="mt-6 lg:mt-0 lg:ml-2">
                                <span class="text-indigo-700 font-semibold">
                                    Personal project
                                </span>
                                <a :href="project.link" target="_blank" rel="noreferrer noopener nofollow" class="">
                                    <h3
                                        class="block mb-8 text-2xl font-bold text-gray-700 dark:text-gray-200 hover:text-indigo-700 transition duration-150">
                                        {{ project.name }}
                                    </h3>
                                </a>

                                <p class="mb-8 text-sm text-gray-500 dark:text-gray-300 md:text-lg">
                                    {{ project.description }}
                                </p>

                                <a :href="project.link" target="_blank" rel="noreferrer noopener nofollow"
                                    class="inline-block mt-2 text-blue-500 underline hover:text-blue-400">
                                    Visit project
                                </a>
                            </div>
                            <img class="bg-auto sm:w-[20rem] md:w-[32rem] lg:w-[24rem] xl:w-[30rem] bg-no-repeat bg-center w-full border-2 rounded-lg"
                                :src="project.image" alt="">
                        </div>
                    </template>
                </div>
            </div>
        </section>
    </Container>
</template>
