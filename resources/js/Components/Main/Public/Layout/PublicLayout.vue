<script setup>
import { ref, defineAsyncComponent } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from "@/Components/Main/Public/Layout/Nav/Navbar.vue";
import ContactButton from "@/Components/Main/Public/Components/Buttons/ContactButton.vue";
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";

const entity = ref(usePage().props.entity);
const callOpenModal = ref(null);

const ContactModal = defineAsyncComponent(() => import('@/Components/Main/Public/Components/Contacts/ContactModal.vue'));

const openModal = () => {
    callOpenModal.value.openModal();
};
</script>

<template>
    <div>
        <Head>
            <meta type="description" name="description" head-key="description"
                content="Transforming ideas into stunning and functional webapps. Boosting online presence with modern, responsive designs optimized for SEO! Discover high-quality web development and Software Engineering">
        </Head>

        <Navbar :entity="entity">
            <template #button>
                <ContactButton @click="openModal()" class="rounded-2xl relative shadow-md shadow-gray-500/20">
                    Contact
                    <span
                        class="absolute -bottom-0 left-[1.125rem] h-px w-[calc(100%-2.25rem)] bg-gradient-to-r from-indigo-200/0 via-indigo-200/90 to-indigo-200/0 transition-opacity duration-400 group-hover:opacity-40">
                    </span>
                </ContactButton>
            </template>
        </Navbar>

        <main class="xs:mx-0 mx-4 mt-20">
            <div class="max-w-[90rem] 2xl:max-w-[100rem] mx-auto">
                <slot />
            </div>
        </main>

        <ContactModal ref="callOpenModal" />
        <MainFooter />
    </div>
</template>