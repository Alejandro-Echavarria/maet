<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    inlineStyle: {
        type: Boolean,
        default: false
    }
});

const textarea = ref(null);
const emit = defineEmits(['update:modelValue']);

onMounted(() => {
    textarea.value.style.height = textarea.value.scrollHeight + 'px';
});

const autoExpand = (e) => {
    emit('update:modelValue', e);
    textarea.value.style.height = 'auto';
    textarea.value.style.height = textarea.value.scrollHeight + 'px';
};
</script>

<template>
    <textarea id="bio" rows="1" ref="textarea" :class="[
        inlineStyle
            ? 'block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition'
            : 'block mt-2 w-full rounded-lg border-0 py-1.5 text-gray-700 ring-1 ring-inset ring-gray-300 dark:text-gray-400 dark:border-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-700 sm:text-sm sm:leading-6 transition'
    ]" :value="modelValue" @input="autoExpand($event.target.value)">
    </textarea>
</template>

<style scoped>
/* Estilos para el textarea */
textarea {
    width: 100%;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
}

div {
    border: 0px solid black;
}
</style>