<script setup>
import { ref, defineAsyncComponent } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ContactButton from "@/Components/Main/Public/Components/Buttons/ContactButton.vue";
import SectionTitle from '@/Components/Main/Public/Components/Titles/SectionTitle.vue';
import BetweenView from "@/Components/Main/Public/Components/OtherComponents/Pojects/BetweenView.vue";


const props = defineProps({
    user: Object,
    jobs: Object
});

const callOpenModal = ref(null);

const ContactModal = defineAsyncComponent(() => import('@/Components/Main/Public/Components/Contacts/ContactModal.vue'));

const openModal = () => {
    callOpenModal.value.openModal();
};
</script>

<template>

    <Head>
        <title>Manuel Echavarria ~ Portfolio</title>
        <meta type="description" name="description" head-key="description"
            content="Transforming ideas into functional webapps. Boosting online presence with modern designs optimized for SEO! Software Engineering & Web Development">
    </Head>

    <div>
        <Navbar :animation="true">
            <template #button>
                <ContactButton @click="openModal()" class="rounded-2xl relative shadow-md shadow-gray-500/20">
                    Contact
                    <span
                        class="absolute -bottom-0 left-[1.125rem] h-px w-[calc(100%-2.25rem)] bg-gradient-to-r from-indigo-200/0 via-indigo-200/90 to-indigo-200/0 transition-opacity duration-400 group-hover:opacity-40">
                    </span>
                </ContactButton>
            </template>
        </Navbar>

        <MainBanner :user="user" :knowledge="user.knowledge" />

        <main class="xs:px-0 mx-4">
            <div class="grid justify-center h-[10vh] mb-20 mt-2 gap-4 sm:gap-4m animate-fade-in-up"
                style="animation-delay: 1.1s;">
                <div>
                    <ContactModal ref="callOpenModal">
                        <template #button>
                            <PrimaryButton @click="openModal" class="sm:w-auto w-full">
                                Get in touch
                            </PrimaryButton>
                        </template>
                    </ContactModal>
                </div>

                <div class="text-sm text-center">
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
                    <section id="about-me-brief">
                        <SectionTitle>
                            <h2 class="py-4 text-5xl lg:text-7xl font-bold text-gray-800 dark:text-gray-200">
                                About me
                            </h2>
                        </SectionTitle>

                        <div class="relative grid grid-cols-1 lg:grid-cols-1 gap-8">
                            <div>
                                <div class="space-y-8 order-3">
                                    <div>
                                        <p v-html="user.bio" />
                                    </div>

                                    <div class="space-y-8">
                                        <template v-if="user.experiences.length > 0">
                                            <div>
                                                <h3 class="p-0">Experiences</h3>
                                            </div>

                                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                                                <div v-for="( experience ) in user.experiences"
                                                    :key="'experience-' + experience.id"
                                                    class="p-4 space-y-2 border rounded-xl border-[#000000]/[0.16]">
                                                    <time class="text-sm font-medium text-gray-600">
                                                        <span>{{ experience.start_date }} -
                                                            {{ experience.end_date }}</span>
                                                    </time>
                                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white p-0">
                                                        {{ experience.title }}
                                                    </h3>

                                                    <p class="dark:text-gray-400 line-clamp-6"
                                                        v-html="experience.description">
                                                    </p>
                                                </div>
                                            </div>
                                        </template>

                                        <template v-if="user.knowledge.length > 0">
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
                                        </template>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-b from-white/0 via-white/50 to-white/100 h-1/4 absolute bottom-0 w-full grid place-content-center content-end">
                                    <div class="py-4">
                                        <Link :href="route('aboutme.index')">
                                        <PrimaryButton>
                                            See more about me
                                        </PrimaryButton>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="relative">
                        <section id="projects">
                            <SectionTitle>
                                <h2 class="py-4 text-5xl lg:text-7xl font-bold text-gray-800 dark:text-gray-200">
                                    Projects
                                </h2>
                            </SectionTitle>

                            <BetweenView :projects="jobs"/>
                        </section>

                        <div
                            class="bg-gradient-to-b from-white/0 via-white/50 to-white/100 h-1/4 absolute bottom-0 w-full grid place-content-center content-end">
                            <div class="py-4">
                                <Link :href="route('jobs.index')">
                                <PrimaryButton>
                                    See all projects
                                </PrimaryButton>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <MainFooter />
    </div>
</template>
