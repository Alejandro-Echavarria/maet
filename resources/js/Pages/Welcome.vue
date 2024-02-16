<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Stacks from "@/Components/Main/Public/Containers/Stacks/Stacks.vue";

let order = false;

const props = defineProps({
    user: Object,
    technologies: Object,
    jobs: Object
});

// const useAnimation = (index) => {
//     return { 'animate-fade-in-up': index === 0 };
// };

const changeOrder = () => {
    return order = !order;
}
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

        <MainBanner :user="user" :technologies="technologies" />

        <!-- <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-8 text-center animate-fade-in-up" style="animation-delay: 1.5s;">Projects</h3> -->
        <main class="xs:px-0 mx-4">
            <div class="grid justify-center h-[10vh] mb-20 mt-2 gap-4 sm:gap-4m animate-fade-in-up"
                style="animation-delay: 1.1s;">
                <div>
                    <PrimaryButton>
                        Send me a message
                    </PrimaryButton>
                </div>

                <div
                    class="text-sm flex items-center gap-4 before:h-px before:flex-1 before:bg-[#000000]/[0.16]  before:content-[''] after:h-px after:flex-1 after:bg-[#000000]/[0.16]  after:content-['']">
                    or take a look
                </div>


                <div class="flex justify-center">
                    <svg class="animate-bounce" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24" fill="none">
                        <path d="M12 20L12 4" stroke="#6b56cb" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M17 15C17 15 13.3176 20 12 20C10.6824 20 7 15 7 15" stroke="#6b56cb" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="max-w-5xl mx-auto">
                <div class="space-y-10 sm:space-y-20">
                    <section id="about-me-brief">
                        <h3 class="text-3xl mb-10 sm:mb-20 font-bold text-gray-700 dark:text-gray-200 text-center">
                            About me
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div>
                                <p v-html="user.bio" />
                            </div>
                            <div class="flex justify-center sm:justify-end">
                                <img class="w-[350px] h-[350px] overflow-auto object-cover" src="/img/others/body.webp"
                                    alt="Manuel Echavarria">
                            </div>
                        </div>
                    </section>

                    <div>
                        <h3 class="text-3xl mb-10 sm:mb-20 font-bold text-gray-700 dark:text-gray-200 text-center">
                            Projects
                        </h3>

                        <div v-for="(job) in jobs" :key="'job-' + job.id"
                            :class="['grid grid-cols-1 sm:grid-cols-2 mb-20 gap-8 w-full justify-between']">
                            <div :class="['w-full', changeOrder() ? 'order-1' : 'sm:order-2', 'space-y-4']">
                                <div>
                                    <span class="block text-indigo-700 font-semibold">
                                        Personal project
                                    </span>
                                    <Link :href="route('jobs.show', job.slug)" target="_blank"
                                        rel="noreferrer noopener nofollow">
                                    <h3
                                        class="block text-2xl font-bold text-gray-700 dark:text-gray-200 hover:text-indigo-700 pb-0">
                                        {{ job.title }}
                                    </h3>
                                    </Link>

                                    <h4 :class="['text-sm font-normal text-gray-500 dark:text-gray-300', 'p-0']">
                                        {{ job.project_name }}
                                    </h4>
                                </div>

                                <p class="text-gray-500 dark:text-gray-300 line-clamp-3" v-html="job.preview" />

                                <div class="hidden sm:block">
                                    <Link :href="route('jobs.show', job.slug)" target="_blank"
                                        rel="noreferrer noopener nofollow"
                                        class="sm:w-auto w-full inline-block mt-2 text-blue-500 underline hover:text-blue-400">
                                    <PrimaryButton class="">
                                        Read more
                                    </PrimaryButton>
                                    </Link>
                                </div>
                            </div>
                            <div :class="['w-full justify-end', order ? 'order-2' : 'order-1']">
                                <Link :href="route('jobs.show', job.slug)" target="_blank"
                                    rel="noreferrer noopener nofollow">
                                <div class="rounded-xl overflow-hidden shadow-gray-500/20 shadow-lg">
                                    <div>
                                        <div class="flex h-6 w-full items-center gap-5 px-3 bg-gray-800">
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
                                        <img fetchpriority="high" class="h-full w-full overflow-auto object-cover"
                                            :src="`/storage/${job?.images[0]?.url}`" :alt="job.alt_banner_image">
                                    </div>
                                </div>
                                </Link>
                                <Stacks :stacks="job.technologies" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <MainFooter />
</div></template>
