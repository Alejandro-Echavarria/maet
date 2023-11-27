<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2">
                <li>
                    <Link :href="route('admin.dashboard')" data-drawer-hide="logo-sidebar"
                        class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                        role="menuitem" :class="route().current('admin.dashboard') ? 'bg-indigo-100 text-indigo-700' : ''">
                    <font-awesome-icon class="w-5 h-5" :icon="['fas', 'chart-line']" />
                    <span class="ml-3">Dashboard</span>
                    </Link>
                </li>

                <li>
                    <Link :href="route('admin.jobs.index')" data-drawer-hide="logo-sidebar"
                        class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                        role="menuitem" :class="route().current('admin.jobs.index') ? 'bg-indigo-100 text-indigo-700' : ''">
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
                    <!-- :key="$page.url + 'button-1'" -->
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-700 rounded-lg group dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 transition duration-300 ease-linear"
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
                        route().current('admin.resume.*')
                        ? 'show'
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
                            <Link :href="route('admin.resume.educations.index')" data-drawer-hide="logo-sidebar"
                                class="flex items-center active p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                                role="menuitem"
                                :class="route().current('admin.resume.*') ? 'bg-indigo-100 text-indigo-700' : ''">
                            <span class="ml-8">Personal info</span>
                            </Link>
                        </li>
                    </ul>
                </li>
                <li>
                    <!-- Config section -->
                    <!-- :key="$page.url + 'button-2'" -->
                    <button type="button"
                        class="flex items-center w-full p-2 text-gray-700 rounded-lg group dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 transition duration-300 ease-linear"
                        aria-controls="dropdown-config" data-collapse-toggle="dropdown-config">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'gear']" />
                        <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item>Config</span>
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
                            <span class="ml-8">Social medias</span>
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
</template>