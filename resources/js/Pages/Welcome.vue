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
        'image': 'img/projects/payments.jpg',
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
    auth: Object
});

const user = props.auth.user;

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
    <Head title="Welcome" />

    <MainBanner :user=user />

    <Container>
        <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-200 mb-8 text-center">Some of my projects</h3>
        <!-- <SliderProjects /> -->

        <section>
            <div class="py-10">
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

                                <a href="{{ project.link }}" target="_blank" rel="noreferrer noopener nofollow"
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

    <Container>
        <div class="min-h-screen">
            <div class="section-bg">
                <div class="w-full flex justify-between px-4">
                    <!-- website Logo -->

                    <div class="flex items-center">
                        <!-- dark and light mode toggle -->
                        <button id="theme-toggle" type="button" class="dark-light-btn">
                            <i id="theme-toggle-dark-icon" class="fa-solid text-xl fa-moon hidden"></i>
                            <i id="theme-toggle-light-icon" class="fa-solid fa-sun text-xl hidden"></i>
                        </button>
                        <!-- mobile toggle button -->
                        <button id="menu-toggle" type="button" class="menu-toggle-btn">
                            <i id="menu-toggle-open-icon" class="fa-solid fa-bars text-xl "></i>
                            <i id="menu-toggle-close-icon" class="fa-solid fa-xmark text-xl hidden  "></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- mobile menu start -->
            <nav id="navbar" class="hidden lg:hidden">
                <ul
                    class="block rounded-b-[20px] shadow-md absolute left-0 top-20 z-[22222222222222] w-full bg-white dark:bg-[#1d1d1d]">
                    <li>
                        <a class="mobile-menu-items-active" href="./aboutOne.html">
                            <span class="mr-2 text-xl">
                                <!-- <i class="fa-regular fa-user"></i> -->
                            </span>
                            Sobre mi
                        </a>
                    </li>
                    <li>
                        <a class="mobile-menu-items" href="./resumeOne.html">
                            <span class="mr-2 text-xl">
                                <!-- <i class="fa-regular fa-file-lines"></i> -->
                            </span>Resumen </a>
                    </li>
                    <li>
                        <a class="mobile-menu-items" href="./portfiloOne.html">
                            <span class="mr-2 text-xl">
                                <!-- <i class="fas fa-briefcase"></i> -->
                            </span>Trabajos </a>
                    </li>
                    <li>
                        <a class="mobile-menu-items" href="./blogOne.html">
                            <span class="mr-2 text-xl">
                                <!-- <i class="fa-brands fa-blogger"></i> -->
                            </span>Blogs </a>
                    </li>
                    <li>
                        <a class="mobile-menu-items" href="./contactOne.html">
                            <span class="mr-2 text-xl">
                                <!-- <i class="fa-solid fa-address-book"></i> -->
                            </span> Contacto </a>
                    </li>
                </ul>
            </nav>
            <!-- mobile menu end -->

            <div class="container grid grid-cols-12 md:gap-10 justify-between lg:mt-[220px]">
                <!-- sidber personal info -->
                <div class="col-span-12 lg:col-span-4 hidden lg:block h-screen sticky top-44">
                    <div
                        class="w-full mb-6 lg:mb-0 mx-auto relative bg-white text-center dark:bg-[#111111] rounded-[20px] mt-[180px] md:mt-[220px] lg:mt-0">
                        <!-- profile image -->
                        <!-- <img src="/img/others/retrato.jpg2"
                            class="w-[240px] absolute left-[50%] transform -translate-x-[50%] h-[240px] drop-shadow-xl mx-auto rounded-[20px] -mt-[140px]"
                            alt="about" /> -->
                        <div class="pt-[100px] pb-8">
                            <h2 class="mt-6 mb-1 text-[26px] font-semibold dark:text-white">
                                <!-- {{ user.name }} -->
                            </h2>
                            <h3
                                class="mb-4 text-[#7B7B7B] inline-block dark:bg-[#1D1D1D] px-5 py-1.5 rounded-lg dark:text-[#A6A6A6]">
                                <!-- {{ user.position }} -->
                            </h3>
                            <div class="flex justify-center space-x-3">
                                <!-- facebook icon and link -->
                                <!-- <a v-for="socialMedia in user.user_social_media" :href="socialMedia.url" target="_blank"
                                    rel="noopener noreferrer">
                                    <span class="socialbtn text-gray-700 dark:text-gray-200"> -->
                                        <!-- <font-awesome-icon :icon="['fab', `${socialMedia.social_media.icon}`]" /> -->
                                    <!-- </span>
                                </a> -->
                            </div>

                            <!-- personal infomation start -->
                            <div class="rounded-2xl mt-7">
                                <template v-for="contact in contactInfo.data" :key="contact.id">
                                    <div class="flex items-center  border-[#E3E3E3] dark:border-[#3D3A3A] pb-2.5">
                                        <span :class='contact.color' class=" bg-white dark:bg-black mr-2 w-2">
                                            <!-- <font-awesome-icon :icon="['fas', `${contact.icon}`]" /> -->
                                        </span>
                                        <div class="text-left ml-2.5">
                                            <p class="text-xs text-[#44566C] dark:text-[#A6A6A6]"> {{ contact.title }} </p>
                                            <p class="dark:text-white">{{ contact.value }}</p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <!-- personal infomation end-->

                            <!-- dowanload button -->
                            <button class="bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <!-- <font-awesome-icon :icon="['fab', 'twitter']" /> -->
                                Descargar CV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Container>
</template>
