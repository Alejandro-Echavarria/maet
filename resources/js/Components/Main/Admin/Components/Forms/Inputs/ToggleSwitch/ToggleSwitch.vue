<script setup>
import { ref } from 'vue';

const props = defineProps({
    modelValue: Boolean,
});

const checked = ref(props.modelValue);
const emit = defineEmits(['update:modelValue']);

const checkbox = (value) => {
    checked.value = !checked.value;
    emit('update:modelValue', checked.value);
};
</script>

<template>
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" @input="checkbox($event.target.value)" :checked="checked" class="sr-only peer">
        <div
            class="w-11 h-6 bg-indigo-700/20 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-offset-2 peer-focus:ring-indigo-700 dark:peer-focus:ring-indigo-700 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-indigo-300 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-indigo-700 after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-700">
        </div>
    </label>
</template>
