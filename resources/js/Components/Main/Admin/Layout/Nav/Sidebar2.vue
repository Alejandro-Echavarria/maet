<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue';
import NavItem from '@/Components/Main/Admin/Layout/Nav/NavItem.vue';

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
            {
                href: '#', label: 'Configuration', active: route().current('admin.socialmedias.*'), activeClass: '/admin/social-medias', children: [
                    { href: 'admin.socialmedias.index', active: route().current('admin.socialmedias.index'), activeClass: '/admin/social-medias', label: 'Social medias', children: [], icon: null },
                ], icon: null
            },
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
    isSidebarVisible.value = !isSidebarVisible.value;
};

const handleResize = () => {
    isSidebarVisible.value = window.innerWidth >= 1024; // Cambiar 1024 por el ancho de resolución deseado para ocultar el sidebar
};
</script>

<template>
    <nav class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button @click="toggleSidebarVisibility" class="mr-2 text-gray-500 lg:hidden">
                        <svg v-if="isSidebarVisible" class="h-6 w-6 transition-transform duration-300 transform rotate-180"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        <svg v-else class="h-6 w-6 transition-transform duration-300 transform rotate-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <!-- <img src="logo.png" alt="Logo" class="h-8"> -->
                    LOGO
                </div>
                <div>
                    <!-- Botones de navegación -->
                </div>
            </div>
        </div>
    </nav>

    <aside :class="['sidebar', { 'collapsed': !isSidebarVisible }]"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">

        <!-- Contenido del sidebar y transición -->
        <transition name="sidebar-transition">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2" :class="{ 'hidden': !isSidebarVisible }">
                    <NavItem :item="item" v-for="item in navItems" :key="item.label" />
                    <!-- <li :key="'li-1'">
                        <Link :href="route('admin.dashboard')"
                            class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                            :class="route().current('admin.dashboard') ? 'bg-indigo-100 text-indigo-700' : 'bg-white'">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'chart-line']" />
                        <span class="ml-3">Dashboard</span>
                        </Link>
                    </li>

                    <li :key="'li-2'">
                        <Link :href="route('admin.jobs.index')"
                            class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                            :class="route().current('admin.jobs.index') ? 'bg-indigo-100 text-indigo-700' : 'bg-white'">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'file-arrow-down']" />
                        <span class="ml-3">Jobs</span>
                        </Link>
                    </li>

                    <li :key="'li-3'">
                        <Link :href="route('admin.services.index')"
                            class="flex items-center p-2 font-bold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear"
                            :class="route().current('admin.services.index') ? 'bg-indigo-100 text-indigo-700' : ''">
                        <font-awesome-icon class="w-5 h-5" :icon="['fas', 'store']" />
                        <span class="ml-3">Services</span>
                        </Link>
                    </li> -->
                    <!-- <li :class="{ 'active': activeMenuItem === 'inicio' }"
                        class="flex items-center py-2 px-8 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        Inicio
                    </li>
                    <li :class="{ 'active': activeMenuItem === 'conversaciones' }"
                        class="flex items-center py-2 px-8 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        Conversaciones
                    </li>
                    <li :class="{ 'active': activeMenuItem === 'configuracion' }"
                        class="flex items-center py-2 px-8 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        Configuración
                    </li> -->
                </ul>
            </div>
        </transition>
    </aside>
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