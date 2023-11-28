<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue';
import { router } from "@inertiajs/vue3";
import NavItem from '@/Components/Main/Admin/Layout/Nav/NavItem.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Drawer2 from '@/Components/Main/Admin/Layout/Nav/Drawer2.vue';

const isSidebarVisible = ref(true);

const navItems = [
    { href: 'admin.dashboard', active: route().current('admin.dashboard'), activeClass: '/admin/dashboard', label: 'Dashboard', children: [], icon: null },
    { href: 'admin.jobs.index', active: route().current('admin.jobs.index'), activeClass: '/admin/jobs', label: 'Jobs', children: [], icon: null },
    { href: 'admin.services.index', active: route().current('admin.services.index'), activeClass: '/admin/services', label: 'Services', children: [], icon: null },
    {
        href: '#', label: 'Personal info', active: route().current('admin.resume.*'), activeClass: (route().current('admin.resume.*') ? '/resume' : '' || route().current('admin.aboutme.index') ? '/about-me' : ''), children: [
            { href: 'admin.aboutme.index', active: route().current('admin.aboutme.index'), activeClass: '/admin/about-me', label: 'About me', children: [], icon: null },
            { href: 'admin.usersocialmedias.index', active: route().current('admin.usersocialmedias.index'), activeClass: '/admin/user-social-medias', label: 'User social medias', children: [], icon: null },
            { href: 'admin.resume.educations.index', active: route().current('admin.resume.*'), activeClass: '/admin/resume', label: 'Personal info', children: [], icon: null },
        ], icon: null
    },
    {
        href: '#', label: 'Configuration', active: route().current('admin.socialmedias.*'), activeClass: '/admin/social-medias', children: [
            { href: 'admin.socialmedias.index', active: route().current('admin.socialmedias.index'), activeClass: '/admin/social-medias', label: 'Social medias', children: [], icon: null },
        ], icon: null
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
    }
};

const handleResize = () => {
    isSidebarVisible.value = window.innerWidth >= 1024; // Cambiar 1024 por el ancho de resolución deseado para ocultar el sidebar
};

const closeSidebar = () => {
    isSidebarVisible.value = false;
}

const logout = () => {
    router.post(route('logout'));
};

defineExpose({ toggleSidebarVisibility });
</script>

<template>
    <nav class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-4 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button @click="toggleSidebarVisibility" class="mr-4 w-5 h-5 text-gray-500 lg:hidden">
                        <div class="space-y-[0.375rem]">
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

                                <DropdownLink :href="route('profile.show')">
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

    <Drawer2 :is-open="isSidebarVisible" @close="closeSidebar" />
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