<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    inlineStyle: {
        type: Boolean,
        default: false
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="relative w-full">
        <div :class="['absolute inset-y-0 left-0 flex items-center pointer-events-none', !inlineStyle && 'border-r border-gray-300 pr-2 my-2']">
            <div id="tech-container" :class="['w-5 h-5', !inlineStyle && 'ml-3', 'overflow-hidden stroke-indigo-700']">
                <span v-if="modelValue" v-html="modelValue" class="w-4 h-4"></span>
                <span v-else>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M12 17L12 3M12 17C12.3728 17 12.6728 16.6574 13.2728 15.9723L15 14M12 17C11.6272 17 11.3272 16.6574 10.7272 15.9723L9 14"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M5 15C3.7492 15.6327 3 16.4385 3 17.3158C3 19.3505 7.02944 21 12 21C16.9706 21 21 19.3505 21 17.3158C21 16.4385 20.2508 15.6327 19 15"
                            stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </span>
            </div>
        </div>
        <input ref="input" type="text" :class="[
            inlineStyle
                ? 'flex-1 w-full lock p-2 pl-7 py-2.5 px-0 text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition'
                : 'block mt-2 w-full rounded-lg border-0 py-1.5 pl-12 text-gray-700 ring-1 ring-inset ring-gray-300 dark:text-gray-400 dark:border-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-700 sm:text-sm sm:leading-6 transition'
        ]" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
    </div>
</template>
