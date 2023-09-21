<script setup>
import { onMounted } from 'vue';
import { Link, router } from "@inertiajs/vue3";
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { initFlowbite } from 'flowbite';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <nav class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            data-drawer-backdrop="true" data-drawer-body-scrolling="true" aria-controls="logo-sidebar"
                            type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="/" class="flex ml-2 md:mr-24">
                            <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" /> -->
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">MAET</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ml-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            :src="$page.props.auth.user.profile_photo_url"
                                            :alt="$page.props.auth.user.name">
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <DropdownLink :href="route('profile.show')">
                                        Profile
                                    </DropdownLink>

                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                        :href="route('api-tokens.index')">
                                        API Tokens
                                    </DropdownLink>

                                    <div class="border-t border-gray-200" />

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <Link :href="route('admin.dashboard')" data-drawer-hide="logo-sidebar"
                            class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                            role="menuitem"
                            :class="route().current('admin.dashboard') ? 'bg-indigo-100 text-indigo-700' : ''">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'chart-line']" />
                        <span class="ml-3">Dashboard</span>
                        </Link>
                    </li>

                    <li>
                        <Link :href="route('admin.jobs.index')" data-drawer-hide="logo-sidebar"
                            class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                            role="menuitem"
                            :class="route().current('admin.jobs.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'file-arrow-down']" />
                        <span class="ml-3">Jobs</span>
                        </Link>
                    </li>

                    <li>
                        <Link :href="route('admin.services.index')" data-drawer-hide="logo-sidebar"
                            class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                            role="menuitem"
                            :class="route().current('admin.services.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'store']" />
                        <span class="ml-3">Services</span>
                        </Link>
                    </li>
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-700 rounded-lg group dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 transition duration-300 ease-linear"
                            aria-controls="dropdown-playground" data-collapse-toggle="dropdown-playground">
                            <font-awesome-icon class="w-5 h-5" :icon="['far', 'file']" />
                            <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item>Personal
                                info</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="dropdown-playground" class="space-y-2 pt-2" :class="route().current('admin.usersocialmedias.index') ||
                                route().current('admin.aboutme.index') ||
                                route().current('admin.resume.index')
                                ? ''
                                : 'hidden'">
                            <li>
                                <Link :href="route('admin.aboutme.index')" data-drawer-hide="logo-sidebar"
                                    class="flex items-center active p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                                    role="menuitem"
                                    :class="route().current('admin.aboutme.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                                <span class="ml-8">About me</span>
                                </Link>
                            </li>

                            <li>
                                <Link :href="route('admin.usersocialmedias.index')" data-drawer-hide="logo-sidebar"
                                    class="flex items-center active p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                                    role="menuitem"
                                    :class="route().current('admin.usersocialmedias.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                                <span class="ml-8">User social medias</span>
                                </Link>
                            </li>

                            <li>
                                <Link :href="route('admin.resume.index')" data-drawer-hide="logo-sidebar"
                                    class="flex items-center active p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                                    role="menuitem"
                                    :class="route().current('admin.resume.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                                <span class="ml-8">Resume</span>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <!-- Config section -->
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-700 rounded-lg group dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 transition duration-300 ease-linear"
                            aria-controls="dropdown-config" data-collapse-toggle="dropdown-config">
                            <font-awesome-icon class="w-5 h-5" :icon="['fas', 'gear']" />
                            <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold"
                                sidebar-toggle-item>Config</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-config" class="space-y-2 pt-2"
                            :class="route().current('admin.socialmedias.index') ? '' : 'hidden'">
                            <li>
                                <Link :href="route('admin.socialmedias.index')" data-drawer-hide="logo-sidebar"
                                    class="flex items-center active p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                                    role="menuitem"
                                    :class="route().current('admin.socialmedias.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                                <span class="ml-8">Social Medias</span>
                                </Link>
                            </li>

                            <li>
                                <Link :href="route('admin.usersocialmedias.index')" data-drawer-hide="logo-sidebar"
                                    class="flex items-center active p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                                    role="menuitem"
                                    :class="route().current('admin.usersocialmedias.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                                <span class="ml-8">Categories</span>
                                </Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="xs:px-0 sm:p-4 lg:p-6 mx-4 sm:ml-64">
            <div class="2xl:max-w-[1500px] max-w-full mx-auto">
                <slot />
            </div>
        </div>
    </div>
</template>