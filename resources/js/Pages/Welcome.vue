<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Stacks from "@/Components/Main/Public/Containers/Stacks/Stacks.vue";
import SectionTitle from '@/Components/Main/Public/Components/Titles/SectionTitle.vue';
import ContactModal from '@/Components/Main/Public/Components/Contacts/ContactModal.vue';

let order = false;

const props = defineProps({
    user: Object,
    jobs: Object
});

const changeOrder = () => {
    return order = !order;
}
</script>

<template>
    <Head>
        <title>Web development ~ Manuel Echavarria</title>
        <meta type="description" name="description" head-key="description"
            content="Transforming ideas into functional webapps. Boosting online presence with modern designs optimized for SEO! Discover high-quality web development and Software Engineering">
    </Head>

    <div>
        <Navbar :animation="true" />

        <MainBanner :user="user" :knowledge="user.knowledge" />

        <main class="xs:px-0 mx-4">
            <div class="grid justify-center h-[10vh] mb-20 mt-2 gap-4 sm:gap-4m animate-fade-in-up"
                style="animation-delay: 1.1s;">
                <div>
                    <!-- <PrimaryButton>
                        Send me a message
                    </PrimaryButton> -->
                    <ContactModal :message="'Get in touch'" />
                </div>

                <div
                    class="text-sm flex items-center gap-4 before:h-px before:flex-1 before:bg-[#000000]/[0.16]  before:content-[''] after:h-px after:flex-1 after:bg-[#000000]/[0.16]  after:content-['']">
                    or take a look
                </div>

                <div class="flex justify-center">
                    <svg class="animate-bounce" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24" fill="none">
                        <path d="M12 20L12 4" class="stroke-indigo-700" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M17 15C17 15 13.3176 20 12 20C10.6824 20 7 15 7 15" class="stroke-indigo-700"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="max-w-5xl mx-auto">
                <div class="space-y-10 sm:space-y-20">
                    <section id="about-me-brief" class="">
                        <SectionTitle :place-bg="'left'">
                            <h3 class="z-10 text-5xl lg:text-7xl font-bold text-gray-800 dark:text-gray-200 text-center">
                                About me
                            </h3>
                        </SectionTitle>

                        <div class="relative grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div class="order-1">
                                <p v-html="user.bio" />
                            </div>
                            <div class="space-y-8 order-3">
                                <div class="space-y-8">
                                    <div>
                                        <h3 class="p-0">Experiences</h3>
                                    </div>
                                    <div v-for="( experience ) in user.experiences" :key="'experience-' + experience.id"
                                        class="p-4 space-y-2 border rounded-xl border-[#000000]/[0.16] order-3">
                                        <time class="text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                            <span>{{ experience.start_date }} - {{ experience.end_date }}</span>
                                        </time>
                                        <h3 class="text-lg font-semibold text-gray-700 dark:text-white p-0">
                                            {{ experience.title }}
                                        </h3>

                                        <p class="dark:text-gray-400 line-clamp-6" v-html="experience.description">
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="p-0">Knowledge</h3>
                                    </div>
                                    <div class="space-y-4 p-4 border rounded-xl border-[#000000]/[0.16]">
                                        <div v-for="( knowledge ) in user.knowledge"
                                            :key="'knowledge-about-me-' + knowledge.id" class="flex">
                                            <div id="tech-container" class="flex gap-2 items-center">
                                                <p class="dark:text-gray-400" v-html="knowledge.name"></p>
                                                <div class="overflow-hidden">
                                                    <i v-html="knowledge.icon" :title="knowledge.name" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gradient-to-b from-white/40 via-white/80 to-white/100 h-1/4 absolute bottom-0 w-full grid place-content-center content-end">
                                <div class="py-4">
                                    <PrimaryButton>
                                        See more about me
                                    </PrimaryButton>
                                </div>
                            </div>

                            <div class="flex justify-center sm:justify-end order-2">
                                <img class="w-[350px] h-[350px] overflow-auto object-cover rounded-xl" src="/img/others/body.webp"
                                    title="Manuel Echavarria" alt="Manuel Echavarria">
                            </div>
                        </div>
                    </section>

                    <div>
                        <section id="projects">
                            <SectionTitle :place-bg="'right'">
                                <h3
                                    class="z-10 text-5xl lg:text-7xl font-bold text-gray-800 dark:text-gray-200 text-center">
                                    Projects
                                </h3>
                            </SectionTitle>

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

                                        <!-- <h4 :class="['text-sm font-normal text-gray-500 dark:text-gray-300', 'p-0']">
                                            {{ job.project_name }}
                                        </h4> -->
                                    </div>

                                    <p class="text-gray-500 dark:text-gray-300 line-clamp-3" v-html="job.preview" />

                                    <div class="hidden sm:block">
                                        <Link :href="route('jobs.show', job.slug)" target="_blank"
                                            rel="noreferrer noopener nofollow"
                                            class="sm:w-auto w-full inline-block mt-2 text-blue-500 underline hover:text-blue-400"
                                            :title="job.title">
                                        <PrimaryButton>
                                            Read more
                                        </PrimaryButton>
                                        </Link>
                                    </div>
                                </div>
                                <div :class="['w-full justify-end', order ? 'order-2' : 'order-1']">
                                    <Link :href="route('jobs.show', job.slug)" target="_blank"
                                        rel="noreferrer noopener nofollow" :title="job.title">
                                    <div class="rounded-xl overflow-hidden shadow-gray-500/20 shadow-lg">
                                        <div>
                                            <div class="flex h-6 w-full items-center gap-5 px-3 bg-gray-800">
                                                <div class="flex items-center gap-1">
                                                    <div class="h-1.5 w-1.5 rounded-full bg-red-400"></div>
                                                    <div class="h-1.5 w-1.5 rounded-full bg-yellow-400"></div>
                                                    <div class="h-1.5 w-1.5 rounded-full bg-emerald-400"></div>
                                                </div>
                                                <div
                                                    class="flex-1 pr-10 text-center text-[0.7rem] text-white leading-loose">
                                                    <p>
                                                        demo.link.com
                                                    </p>
                                                </div>
                                            </div>
                                            <img fetchpriority="high" class="h-full w-full overflow-auto object-cover"
                                                :title="job.alt_banner_image" :src="`/storage/${job?.images[0]?.url}`"
                                                :alt="job.alt_banner_image">
                                        </div>
                                    </div>
                                    </Link>
                                    <Stacks :stacks="job.technologies" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
        <MainFooter />
    </div>
</template>
