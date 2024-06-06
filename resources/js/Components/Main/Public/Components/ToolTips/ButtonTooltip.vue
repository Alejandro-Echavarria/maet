<script setup>
import { ref } from 'vue';

const props = defineProps({
    content: {
        type: String,
        required: true,
        default: null
    }
});

const tooltipVisible = ref(false);

const showTooltip = () => {
    tooltipVisible.value = true;
};

const hideTooltip = () => {
    tooltipVisible.value = false;
};
</script>

<template>
    <!--
        Inspirado por Eduardo José
        https://uiverse.io/eduardojsc18/serious-seahorse-3
    -->
    <button
        class="block font-medium text-neutral-600 relative z-[40] focus:outline-none"
        @mouseover="showTooltip" @mouseleave="hideTooltip" @focus="showTooltip" @blur="hideTooltip" @touchstart="showTooltip" @touchend="hideTooltip">
        <slot />
        <span :class="['tooltip', { 'tooltip-visible': tooltipVisible }]"
            class="bg-gray-800 absolute bottom-[calc(100%+8px)] left-1/2 transform -translate-x-1/2 px-1.5 py-1 min-w-fit rounded-md drop-shadow text-center text-white whitespace-nowrap text-[12px] transition-all duration-300 origin-bottom">
            {{ content }}
            <span :class="['triangle', { 'triangle-visible': tooltipVisible }]"
                class="absolute bg-gray-800 top-full left-1/2 transform -translate-x-1/2 w-3 h-[4px] clip-path-polygon transition-all duration-300"></span>
        </span>
    </button>
</template>

<style>
.clip-path-polygon {
    clip-path: polygon(0% 0%, 50% 100%, 100% 0%);
}

.tooltip {
    opacity: 0;
    transform: scale(0.95) translateX(-50%);
}

.tooltip-visible {
    opacity: 1;
    transform: scale(1) translateX(-50%);
}

.triangle {
    opacity: 0;
    transform: scale(0.95) translateX(-50%);
}

.triangle-visible {
    opacity: 1;
    transform: scale(1) translateX(-50%);
}
</style>
