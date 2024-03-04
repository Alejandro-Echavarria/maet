<script setup>
const props = defineProps({
    placeBg: {
        type: String,
    }
});
</script>

<template>
    <div class="relative">
        <div class="mb-10 sm:mb-20 flex justify-center">
            <slot />
        </div>
        <span
            class="absolute -bottom-0 left-[1.125rem] md:left-[20.125rem] h-[4px] w-[calc(100%-2.25rem)] md:w-[calc(100%-40.25rem)] bg-gradient-to-r from-indigo-700/0 via-indigo-700/10 to-indigo-700/0 transition-opacity duration-400 group-hover:opacity-40">
        </span>
    </div>
</template>
