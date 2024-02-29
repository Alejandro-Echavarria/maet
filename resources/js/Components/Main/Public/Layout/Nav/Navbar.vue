<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

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

                    <div class="flex items-center space-x-2 border-spacing-2">
                        <div>
                            <slot name="button" />
                            <!-- <PrimaryButton class="rounded-2xl relative shadow-md shadow-gray-500/20">
                                Contact
                                <span
                                    class="absolute -bottom-0 left-[1.125rem] h-px w-[calc(100%-2.25rem)] bg-gradient-to-r from-indigo-200/0 via-indigo-200/90 to-indigo-200/0 transition-opacity duration-400 group-hover:opacity-40">
                                </span>
                            </PrimaryButton> -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>