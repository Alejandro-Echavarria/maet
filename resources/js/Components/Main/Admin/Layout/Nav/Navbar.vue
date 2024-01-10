<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue';
import { router } from "@inertiajs/vue3";
import NavItem from '@/Components/Main/Admin/Layout/Nav/NavItem.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const isSidebarVisible = ref(true);
const isBackDropVisible = ref(false);

const navItems = [
    { href: 'admin.dashboard', active: route().current('admin.dashboard'), activeClass: '/admin/dashboard', label: 'Dashboard', children: [], icon: ['fas', 'chart-line'] },
    { href: 'admin.jobs.index', active: route().current('admin.jobs.index'), activeClass: '/admin/jobs', label: 'Jobs', children: [], icon: ['fas', 'file-arrow-down'] },
    { href: 'admin.services.index', active: route().current('admin.services.index'), activeClass: '/admin/services', label: 'Services', children: [], icon: ['fas', 'store'] },
    {
        href: '#', label: 'Personal info', active: route().current('admin.resume.*'), activeClass: (route().current('admin.resume.*') ? '/resume' : '' || route().current('admin.aboutme.index') ? '/about-me' : ''), children: [
            { href: 'admin.aboutme.index', active: route().current('admin.aboutme.index'), activeClass: '/admin/about-me', label: 'About me', children: [], icon: null },
            { href: 'admin.usersocialmedias.index', active: route().current('admin.usersocialmedias.index'), activeClass: '/admin/user-social-medias', label: 'User social medias', children: [], icon: null },
            { href: 'admin.resume.educations.index', active: route().current('admin.resume.*'), activeClass: '/admin/resume', label: 'Personal info', children: [], icon: null },
        ], icon: ['far', 'file']
    },
    {
        href: '#', label: 'Configuration', active: route().current('admin.socialmedias.*'), activeClass: '/admin/social-medias', children: [
            { href: 'admin.socialmedias.index', active: route().current('admin.socialmedias.index'), activeClass: '/admin/social-medias', label: 'Social medias', children: [], icon: null },
        ], icon: ['fas', 'gear']
    },
];

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
});

const toggleSidebarVisibility = () => {
    if (window.innerWidth < 1024) {
        isSidebarVisible.value = !isSidebarVisible.value;
        document.body.classList.toggle('overflow-hidden', isSidebarVisible.value);
    }
};

const handleResize = () => {
    isSidebarVisible.value = window.innerWidth >= 1024; // Cambiar 1024 por el ancho de resolución deseado para ocultar el sidebar
    isBackDropVisible.value = window.innerWidth < 1024;
};

const logout = () => {
    router.post(route('logout'));
};

defineExpose({ toggleSidebarVisibility });
</script>

<template>
    <nav class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-4 h-12 flex items-center lg:px-5 lg:pl-3">
            <div class="w-full h-full flex items-center justify-between">
                <div class="flex items-center justify-start h-full">
                    <button @click="toggleSidebarVisibility" class="mr-4 w-5 h-full text-gray-500 lg:hidden">
                        <div class="space-y-[0.375rem] h-auto">
                            <div
                                :class="['w-5 h-[2px] rounded-lg bg-gray-600', isSidebarVisible ? '-translate-y-[2.5px] origin-left rotate-[44deg] transition duration-150' : 'rotate-0 transition-all duration-150 ease-linear']">
                            </div>
                            <div
                                :class="['w-3 h-[2px] rounded-lg bg-gray-600', isSidebarVisible ? 'w-5 translate-y-[3.5px] translate-x-[1px] origin-left -rotate-[48deg] transition duration-150 ease-linear' : 'rotate-0 transition-all duration-150 ease-linear']">
                            </div>
                        </div>
                    </button>
                    <a href="/" class="flex md:mr-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                            MAET
                        </span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-7 w-7 rounded-full object-cover"
                                        :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                </button>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>

                                <DropdownLink :href="route('profile.show')" @click="handleResize">
                                    Profile
                                </DropdownLink>

                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
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

    <aside :class="['sidebar', { 'collapsed': !isSidebarVisible }]"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">

        <!-- Contenido del sidebar y transición -->
        <transition name="sidebar-transition">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <div class="space-y-2" :class="{ 'hidden': !isSidebarVisible }">
                    <NavItem :item="item" v-for="item in navItems" @click="toggleSidebarVisibility" :key="item.label" />
                </div>
            </div>
        </transition>
    </aside>

    <transition enter-active-class="ease-out duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100"
        leave-active-class="ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-if="isBackDropVisible && isSidebarVisible" @click="toggleSidebarVisibility"
            class="fixed inset-0 transform transition-all bg-gray-900/50 backdrop-blur backdrop-filter opacity-100 z-30" />
    </transition>
</template>

<style scoped>
.sidebar {
    width: 16rem;
    transition: width 0.3s ease;
    overflow: hidden;
}

.sidebar.collapsed {
    width: 0;
}

.sidebar-transition-enter-active,
.sidebar-transition-leave-active {
    transition: width 0.3s ease;
}

.sidebar-transition-enter,
.sidebar-transition-leave-to {
    width: 0;
}

.sidebar-menu {
    opacity: 1;
    transition: opacity 0.3s ease;
}

.sidebar.collapsed .sidebar-menu {
    opacity: 0;
}

/* Resto de los estilos... */
</style>