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
        name: 'Jobs',
        routeName: 'jobs.index',
        active: 'jobs.*'
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
    }
};
</script>

<template>
    <div class="fixed top-1 z-50 w-full flex justify-center mb-8 px-2 overflow-hidden">
        <nav :class="['w-full z-50 mt-1 max-w-[90rem] 2xl:max-w-[100rem] backdrop-blur-md rounded-3xl border border-[#000000]/[0.16]', { 'animate-fade-in-down': props.animation }]"
            style="animation-delay: 1.1s;">
            <div :class="['px-2 h-12 w-full']">
                <div :class="['w-full h-full flex items-center justify-between']">
                    <div class="flex items-center justify-start h-full">

                        <Link href="/" class="flex md:mr-24 gap-2">
                        <ApplicationLogo />
                        <span
                            class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-gray-200 text-gray-800">
                            MAET
                        </span>
                        </Link>
                    </div>

                    <div class="hidden md:flex items-center space-x-3 divide-x divide-[#000000]/[0.16]">
                        <ul class="flex items-center space-x-6">
                            <li>
                                <NavLink href="/" :active="route().current('welcome')">
                                    Home
                                </NavLink>
                            </li>
                            <li>
                                <NavLink :href="route('jobs.index')" :active="route().current('jobs.*')">
                                    Jobs
                                </NavLink>
                                <!-- <Link :href="route('jobs.index')" class="font-semibold text-gray-800 hover:text-gray-500 dark:text-gray-200 transition duration-300">Jobs</Link> -->
                            </li>
                            <li>
                                <!-- <NavLink href="/" :active="route().current('welcome')">
                                    About me
                                </NavLink> -->
                            </li>
                        </ul>
                        <div class="pl-3">
                            <slot name="button" />
                        </div>
                    </div>

                    <button type="button" id="hamburgerButton" @click="toggleVisibility" class="mr-2 w-5 h-full text-gray-500 md:hidden">
                        <div class="space-y-[0.375rem] h-auto">
                            <div
                                :class="['w-5 h-[2px] rounded-lg bg-gray-800', isVisible ? '-translate-y-[3px] origin-left rotate-[47deg] translate-x-[7px] transition duration-150' : 'rotate-0 transition-all duration-150 ease-linear']">
                            </div>
                            <div
                                :class="['ml-2 w-3 h-[2px] rounded-lg bg-gray-800', isVisible ? 'w-5 translate-y-[3.5px] origin-left -rotate-[51deg] transition duration-150 ease-linear' : 'rotate-0 transition-all duration-150 ease-linear']">
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <div :class="['h-[90dvh] overflow-y-auto collapse-transition', { 'collapse': !isVisible }]">
                <div :class="['px-4 my-5', { 'hidden': !isVisible }]">
                    <ResponsiveNavLink v-for="(navLink, index) in navLinks" :key="'nav-link-' + index"
                        :href="route(navLink.routeName)" :active="route().current(navLink.active)"
                        :class="['animate-fade-in']" :style="{ animationDelay: `${index * 0.05}s` }">
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
    /* height: 90vh; */
    transition: height 0.5s ease;
    overflow: hidden;
}

.collapse-transition.collapse {
    height: 0;
}
</style>