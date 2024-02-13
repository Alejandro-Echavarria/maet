<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Stacks from "@/Components/Main/Public/Containers/Stacks/Stacks.vue";

let order = false;

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

const changeOrder = () => {
    return order = !order;
}

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
                <div class="space-y-10 sm:space-y-20">
                    <section id="about-me-brief">
                        <h3 class="text-3xl mb-10 sm:mb-20 font-bold text-gray-700 dark:text-gray-200 text-center animate-fade-in-up"
                            style="animation-delay: 1.1s;">
                            About me
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 animate-fade-in-up"
                            style="animation-delay: 1.1s;">
                            <div>
                                <p v-html="user.bio" />
                            </div>
                            <div class="flex justify-end">
                                <img class="w-[350px] h-[350px] overflow-auto object-cover" src="/img/others/body.png"
                                    alt="Manuel Echavarria">
                            </div>
                        </div>
                    </section>

                    <div>
                        <h3 class="text-3xl mb-10 sm:mb-20 font-bold text-gray-700 dark:text-gray-200 text-center">
                            Projects
                        </h3>

                        <div v-for="(job, index) in jobs" :key="'job-' + job.id" :style="{ animationDelay: `1.1s` }"
                            :class="['grid grid-cols-1 sm:grid-cols-2 mb-10 sm:mb-20 gap-8 w-full justify-between', useAnimation(index)]">
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
    </div>
</template>
