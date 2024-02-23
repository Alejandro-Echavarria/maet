<script setup>
const props = defineProps({
    placeBg: {
        type: String,
    }
});
</script>

<template>
    <div class="relative">
        <!-- <div
            class="mb-10 sm:mb-20 flex items-center before:flex-[1_1_0%] before:border-t before:border-[#000000]/[0.16] before:me-6 after:flex-[1_1_0%] after:border-t after:border-[#000000]/[0.16] after:ms-6 dark:text-white dark:before:border-gray-600 dark:after:border-gray-600">
            <slot />
        </div> -->

        <div class="mb-10 sm:mb-20">
            <slot />
        </div>

        <div :class="['absolute w-1/2 bg-indigo-700/10 top-6 sm:top-11 rounded-full z-0 shadow-lg', `${placeBg}-20`]">
            <div class="h-12"></div>
        </div>
    </div>
</template>
