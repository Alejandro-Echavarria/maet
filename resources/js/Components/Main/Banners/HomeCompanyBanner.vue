<script setup>
import { ref, defineAsyncComponent } from "vue";
import Container from "@/Components/Main/Containers/Container.vue";
import ContactButton from "@/Components/Main/Public/Components/Buttons/ContactButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    entity: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
    },
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
    <div class="w-full h-[80vh] sm:h-[80vh] relative">
        <div class="backdrop-blur-2xl bg-gradient-to-b from-white/80 to-blue-50/10 h-full">
            <Container class="h-full flex items-center mt-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 content-center gap-8">
                    <div class="space-y-8 grid content-center">
                        <div class="w-full flex flex-col text-center sm:text-left">
                            <h1 class="text-3xl lg:text-5xl font-semibold bg-gradient-to-r from-gray-800 via-indigo-700 to-blue-700 bg-clip-text text-transparent animate-fade-in-left"
                                style="
                                    animation-delay: 0.1s;
                                    animation-duration: 0.4s;
                                ">
                                Creating Success with Custom Web Apps
                            </h1>

                            <h2 class="mt-8 text-lg lg:text-xl font-semibold dark:text-white">
                                {{ user.position }}
                            </h2>
                        </div>

                        <div class="space-y-4">
                            <div class="flex self-end gap-4">
                                <ContactButton @click="openModal()"
                                    class="rounded-lg relative shadow-md shadow-gray-500/20">
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

                                <SecondaryButton :hidden="false">
                                    Projects
                                </SecondaryButton>
                            </div>
                        </div>
                    </div>

                    <div>
                        <img src="https://i.postimg.cc/kgd4WhyS/container.png" alt=""
                            class="w-full h-full aspect-video object-cover rounded-xl shadow-gray-500/20 shadow-lg border border-[#000000]/[0.16]" />
                    </div>
                </div>

                <div
                    class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px]">
                    <div
                        class="absolute left-0 right-0 top-0 -z-10 m-auto h-[310px] w-[310px] rounded-full bg-indigo-700 opacity-20 blur-[100px]">
                    </div>
                </div>
            </Container>
        </div>
    </div>

    <ContactModal ref="callOpenModal" />
</template>
