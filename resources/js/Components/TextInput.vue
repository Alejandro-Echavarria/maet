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
    <input ref="input" :class="[
        inlineStyle
            ? 'block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition'
            : 'block mt-2 w-full rounded-lg border-0 py-1.5 text-gray-700 ring-1 ring-inset ring-gray-300 dark:text-gray-400 dark:border-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-700 sm:text-sm sm:leading-6 transition'
    ]" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
</template>
