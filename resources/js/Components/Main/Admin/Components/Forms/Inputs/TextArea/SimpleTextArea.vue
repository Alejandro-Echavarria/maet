<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

const bioTextarea = ref(null);
const emit = defineEmits(['update:modelValue']);

onMounted(() => {
    bioTextarea.value.style.height = bioTextarea.value.scrollHeight + 'px';
});

const autoExpand = (e) => {
    emit('update:modelValue', e);
    bioTextarea.value.style.height = 'auto';
    bioTextarea.value.style.height = bioTextarea.value.scrollHeight + 'px';
};
</script>

<template>
    <div>
        <textarea id="bio" rows="1" ref="bioTextarea"
            class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition"
            placeholder="Your bio" :value="modelValue" @input="autoExpand($event.target.value)">
        </textarea>
    </div>
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