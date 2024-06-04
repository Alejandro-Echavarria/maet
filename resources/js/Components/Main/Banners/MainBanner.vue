<script setup>
import { ref, defineAsyncComponent } from "vue";
import { Link } from '@inertiajs/vue3';
import Container from '@/Components/Main/Containers/Container.vue';
import ContactButton from "@/Components/Main/Public/Components/Buttons/ContactButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import CircleStack from "@/Components/Main/Public/Containers/Stacks/CircleStack.vue";

const { user } = defineProps({
    user: {
        type: Object,
    },
    knowledge: {
        type: Object,
    }
});

const callOpenModal = ref(null);

const ContactModal = defineAsyncComponent(() =>
    import("@/Components/Main/Public/Components/Contacts/ContactModal.vue")
);

const openModal = () => {
    callOpenModal.value.openModal();
};
</script>

<template>
    <div class="w-full h-[80vh] relative">
        <div class="backdrop-blur-2xl bg-gradient-to-b from-white/80 to-blue-50/10 h-full">
            <Container class="h-full flex items-center mt-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 content-center gap-8">
                    <div class="space-y-8 grid content-center">
                        <div class="w-full flex flex-col text-center sm:text-left space-y-6">
                            <div>
                                <div>
                                    <span
                                        class="text-4xl lg:text-5xl font-semibold bg-gradient-to-r from-gray-800 via-indigo-700 to-blue-700 bg-clip-text text-transparent">
                                        Hey,
                                    </span>
                                </div>
                                <h1 class="text-4xl lg:text-5xl font-semibold bg-gradient-to-r from-gray-800 via-indigo-700 to-blue-700 bg-clip-text text-transparent animate-fade-in-left"
                                    style="animation-delay: 0.1s; animation-duration: 0.4s;">
                                    <span>I'm</span> {{ user.name }}
                                </h1>
                            </div>

                            <h2 class="text-lg lg:text-xl font-medium dark:text-white animate-fade-in"
                                style="animation-delay: 0.60s;">
                                {{ user.position }}
                            </h2>

                            <h2 class="text-lg lg:text-xl font-semibold dark:text-white animate-fade-in"
                                style="animation-delay: 0.60s;">
                                Passionate About Helping Others Succeed With Web Apps & Data
                            </h2>
                        </div>

                        <div class="space-y-4">
                            <div class="flex self-end gap-4">
                                <ContactButton @click="openModal()"
                                    class="rounded-lg relative shadow-md shadow-gray-500/20 animate-fade-in-up"
                                    style="animation-delay: 1.1s;">
                                    <span class="relative flex h-2 w-2 mr-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-200 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                                    </span>
                                    Get in touch
                                    <span
                                        class="absolute -bottom-0 left-[1.125rem] h-px w-[calc(100%-2.25rem)] bg-gradient-to-r from-indigo-200/0 via-indigo-200/90 to-indigo-200/0 transition-opacity duration-400 group-hover:opacity-40">
                                    </span>
                                </ContactButton>

                                <Link :href="route('jobs.index')" title="All My Projects">
                                <SecondaryButton :hidden="false" class="animate-fade-in-up"
                                    style="animation-delay: 1.1s;">
                                    Projects
                                </SecondaryButton>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div class="animate-fade-in sm:mt-0 mt-10" style="animation-delay: 1.1s;">
                        <CircleStack :stacks="knowledge" />
                    </div>
                </div>

                <div
                    class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px]">
                    <div class="relative h-full w-full bg-white">
                        <div
                            class="absolute h-full w-full bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_70%,transparent_100%)]">
                        </div>
                    </div>
                </div>
            </Container>
        </div>
    </div>

    <!-- <div class="grid items-center my-4">
        <div>
            <Stacks :title="'Main Tech'" :stacks="knowledge" />
        </div>
    </div> -->

    <ContactModal ref="callOpenModal" />
</template>
