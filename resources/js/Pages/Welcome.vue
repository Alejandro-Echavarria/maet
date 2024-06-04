<script setup>
import { ref, defineAsyncComponent } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import MainBanner from '@/Components/Main/Banners/MainBanner.vue';
import Navbar from '@/Components/Main/Public/Layout/Nav/Navbar.vue';
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ContactButton from "@/Components/Main/Public/Components/Buttons/ContactButton.vue";
import SectionTitle from '@/Components/Main/Public/Components/Titles/SectionTitle.vue';
import BetweenView from "@/Components/Main/Public/Components/OtherComponents/Pojects/BetweenView.vue";

const props = defineProps({
    user: Object,
    jobs: Object
});

const entity = ref(usePage().props.entity);

const callOpenModal = ref(null);

const ContactModal = defineAsyncComponent(() =>
    import("@/Components/Main/Public/Components/Contacts/ContactModal.vue")
);

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
        <Navbar :entity="entity" :animation="true">
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
            <div class="grid justify-center h-[10vh] mt-2 gap-4 sm:gap-4m animate-fade-in-up"
                style="animation-delay: 1.1s;">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
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
                    <section v-if="user.bio" id="about-me-brief" class="text-center">
                        <SectionTitle>
                            <h2 class="py-4 text-3xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200">
                                About me
                            </h2>
                        </SectionTitle>

                        <div class="relative grid grid-cols-1 lg:grid-cols-1 gap-8">
                            <div class="space-y-8">
                                <div>
                                    <p v-html="user.bio" />
                                </div>

                                <div>
                                    <Link :href="route('aboutme.index')">
                                    <SecondaryButton :hidden="false">
                                        See more
                                    </SecondaryButton>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="relative pb-1" v-if="jobs.length > 0">
                        <section id="projects">
                            <SectionTitle>
                                <h2 class="py-4 text-3xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200">
                                    Projects
                                </h2>
                            </SectionTitle>

                            <BetweenView :projects="jobs" />
                        </section>

                        <div class="flex justify-center">
                            <Link :href="route('jobs.index')">
                            <PrimaryButton>
                                View all
                            </PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <MainFooter />
        <ContactModal ref="callOpenModal" />
    </div>
</template>
