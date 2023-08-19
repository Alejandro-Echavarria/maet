<script setup>
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

defineOptions({
    layout: MainLayout
});
</script>

<template>
    <div>
        <Head title="Profile" />

        <MainTitle>
            Profile
        </MainTitle>

        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
            <UpdateProfileInformationForm :user="$page.props.auth.user" />

            <SectionBorder />
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
            <UpdatePasswordForm class="mt-10 sm:mt-0" />

            <SectionBorder />
        </div>

        <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
            <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" class="mt-10 sm:mt-0" />

            <SectionBorder />
        </div>

        <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

        <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
            <SectionBorder />

            <DeleteUserForm class="mt-10 sm:mt-0" />
        </template>
    </div>
</template>
