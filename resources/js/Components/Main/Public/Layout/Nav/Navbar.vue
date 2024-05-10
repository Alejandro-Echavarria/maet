<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const props = defineProps({
    animation: {
        type: Boolean,
        default: false
    }
});

const isVisible = ref(false);
const isBackDropVisible = ref(true);

const navLinks = ref([
    {
        name: 'Home',
        routeName: 'welcome',
        active: 'welcome'
    },
    {
        name: 'Projects',
        routeName: 'jobs.index',
        active: '/jobs'
    },
    {
        name: 'About me',
        routeName: 'aboutme.index',
        active: '/about-me'
    },
]);

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
});

const toggleVisibility = () => {
    if (window.innerWidth < 768) {
        isVisible.value = !isVisible.value;
        document.body.classList.toggle('overflow-hidden', isVisible.value);
    }
};

const handleResize = () => {
    if (window.innerWidth > 768) {
        isVisible.value = window.innerWidth <= 768; // Cambiar 1024 por el ancho de resolución deseado para ocultar el sidebar
        isBackDropVisible.value = window.innerWidth <= 768;
        document.body.classList.toggle('overflow-hidden', isVisible.value);
    }
};
</script>

<template>
    <div class="fixed top-1 z-50 w-full flex justify-center mb-8 px-2">
        <nav :class="['shadow-gray-500/10 shadow-md w-full z-50 mt-1 max-w-[90rem] 2xl:max-w-[100rem] bg-white/40 backdrop-blur-xl rounded-3xl border border-[#000000]/[0.16] transition-all duration-700', { 'animate-fade-in-down': props.animation }, { 'bg-white': isVisible }]"
            style="animation-delay: 1.1s;">
            <div :class="[' px-2 h-12 w-full']">
                <div :class="['w-full h-full flex items-center justify-between']">
                    <div class="flex items-center justify-start h-full">
                        <Link href="/" @click="isVisible && toggleVisibility()" class="flex md:mr-24 gap-2">
                        <ApplicationLogo />
                        <span
                            class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-gray-200 text-gray-800">
                            {{ $page.props.entity?.name }}
                        </span>
                        </Link>
                    </div>

                    <div class="hidden md:flex items-center space-x-3 divide-x divide-[#000000]/[0.16]">
                        <ul class="flex items-center space-x-6">
                            <li v-for="(navLink, index) in navLinks">
                                <NavLink :href="route(navLink.routeName)"
                                    :active="route().current(navLink.active) || $page.url.startsWith(navLink.active)"
                                    :key="'nav-link-' + index">
                                    {{ navLink.name }}
                                </NavLink>
                            </li>
                        </ul>
                        <div class="pl-3">
                            <slot name="button" />
                        </div>
                    </div>

                    <button type="button" id="hamburgerButton" name="hamburgerButton" aria-label="hamburgerButton"
                        @click="toggleVisibility" class="mr-2 w-5 h-full text-gray-500 md:hidden">
                        <div class="space-y-[0.375rem] h-auto">
                            <div
                                :class="['w-5 h-[2px] rounded-lg bg-gray-800', isVisible ? '-translate-y-[3px] origin-left rotate-[45deg] translate-x-[7px] transition duration-150' : 'rotate-0 transition-all duration-150 ease-linear']">
                            </div>
                            <div
                                :class="['ml-2 w-3 h-[2px] rounded-lg bg-gray-800', isVisible ? 'w-5 translate-y-[3.5px] origin-left -rotate-[49deg] transition duration-150 ease-linear' : 'rotate-0 transition-all duration-150 ease-linear']">
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <div :class="['h-[90dvh] overflow-y-auto collapse-transition', { 'collapse': !isVisible }]">
                <div :class="['px-2 my-2', { 'hidden': !isVisible }]">
                    <ResponsiveNavLink v-for="(navLink, index) in navLinks" :key="'responsive-nav-link-' + index"
                        :href="route(navLink.routeName)"
                        :active="route().current(navLink.active) || $page.url.startsWith(navLink.active)"
                        :class="['animate-fade-in']" :style="{ animationDelay: `${index * 0.05}s` }"
                        @click="toggleVisibility">
                        {{ navLink.name }}
                    </ResponsiveNavLink>
                </div>
            </div>
        </nav>
    </div>

    <div v-if="isBackDropVisible && isVisible" @click="toggleVisibility" class="fixed inset-0 z-40" />
</template>

<style>
.collapse-transition {
    transition: height 0.5s ease;
    overflow: hidden;
}

.collapse-transition.collapse {
    height: 0;
}
</style>