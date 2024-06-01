<script setup>
import { ref, defineAsyncComponent } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import MainBanner from "@/Components/Main/Banners/MainBanner.vue";
import Navbar from "@/Components/Main/Public/Layout/Nav/Navbar.vue";
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ContactButton from "@/Components/Main/Public/Components/Buttons/ContactButton.vue";
import SectionTitle from "@/Components/Main/Public/Components/Titles/SectionTitle.vue";
import BetweenView from "@/Components/Main/Public/Components/OtherComponents/Pojects/BetweenView.vue";

const props = defineProps({
    // user: Object,
    jobs: Object,
});

const entity = ref(usePage().props.entity);
const callOpenModal = ref(null);

const openModal = () => {
    callOpenModal.value.openModal();
};
</script>

<template>
    <Head>
        <title>{{ entity?.name }} - Home</title>
        <meta
            type="description"
            name="description"
            head-key="description"
            content="Transforming ideas into functional webapps. Boosting online presence with modern designs optimized for SEO! Software Engineering & Web Development"
        />
    </Head>

    <Navbar :entity="entity" :animation="true">
        <template #button>
            <ContactButton
                @click="openModal()"
                class="rounded-2xl relative shadow-md shadow-gray-500/20"
            >
                Contact
                <span
                    class="absolute -bottom-0 left-[1.125rem] h-px w-[calc(100%-2.25rem)] bg-gradient-to-r from-indigo-200/0 via-indigo-200/90 to-indigo-200/0 transition-opacity duration-400 group-hover:opacity-40"
                >
                </span>
            </ContactButton>
        </template>
    </Navbar>
</template>
