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
        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
            <svg :class="`w-4 h-4 ${ !inlineStyle && 'ml-3' } text-gray-500 dark:text-gray-400`" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
            </svg>
        </div>
        <input ref="input" :class="[
            inlineStyle
                ? 'flex-1 w-full lock p-2 pl-7 py-2.5 px-0 text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition'
                : 'block mt-2 w-full rounded-lg border-0 py-1.5 pl-10 text-gray-700 ring-1 ring-inset ring-gray-300 dark:text-gray-400 dark:border-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-700 sm:text-sm sm:leading-6 transition'
        ]" placeholder="Enter amount" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
    </div>
</template>