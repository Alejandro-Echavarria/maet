<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    animation: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <div class="fixed top-1 z-50 w-full flex justify-center mb-8 px-2 overflow-hidden">
        <nav :class="['w-full z-50 mt-1 max-w-[90rem] 2xl:max-w-[100rem] backdrop-blur-md rounded-3xl border border-[#000000]/[0.16]', { 'animate-fade-in-down': props.animation }]"
            style="animation-delay: 1.1s;">
            <div :class="['px-4 h-12 w-full']">
                <div :class="['w-full h-full flex items-center justify-between']">
                    <div class="flex items-center justify-start h-full">
                        <!-- <button @click="toggleSidebarVisibility" class="mr-4 w-5 h-full text-gray-500 lg:hidden">
                            <div class="space-y-[0.375rem] h-auto">
                                <div
                                    :class="['w-5 h-[2px] rounded-lg bg-gray-600', isSidebarVisible ? '-translate-y-[2.5px] origin-left rotate-[44deg] transition duration-150' : 'rotate-0 transition-all duration-150 ease-linear']">
                                </div>
                                <div
                                    :class="['w-3 h-[2px] rounded-lg bg-gray-600', isSidebarVisible ? 'w-5 translate-y-[3.5px] translate-x-[1px] origin-left -rotate-[48deg] transition duration-150 ease-linear' : 'rotate-0 transition-all duration-150 ease-linear']">
                                </div>
                            </div>
                        </button> -->
                        <Link href="/" class="flex md:mr-24">
                        <span
                            class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-gray-200 text-gray-800">
                            MAET
                        </span>
                        </Link>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>