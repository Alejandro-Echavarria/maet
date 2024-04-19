<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    modelValue: String,
    file: String,
    typeImage: {
        type: String,
        default: 'banners',
    },
    access: {
        type: String,
        default: 'storage',
    }
});

const emit = defineEmits('update:modelValue');
const fileName = ref('');

const cambiarImagen = (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = (event) => {
        document.getElementById('img-post').setAttribute('src', event.target.result);
        fileName.value = file.name;
    };

    reader.onerror = (error) => {
        console.error('Error al leer el archivo:', error);
    };

    reader.readAsDataURL(file);
    emit('update:modelValue', file);
};

const typeImageClass = computed(() => {
    return {
        'banners': 'h-96 rounded-lg w-full',
        'clients': 'h-full w-full rounded-full',
    }[props.typeImage];
});
</script>

<template>
    <div>
        <div class="flex items-center justify-center w-full">
            <label for="file"
                :class="[typeImageClass]"
                class="overflow-hidden flex items-center justify-center border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <template v-if="file === null || !file">
                    <div class="flex flex-col items-center text-center justify-center space-y-4">
                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p v-if="typeImage === 'banners'" class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">Click to upload</span> an image for the job banner
                        </p>
                    </div>
                </template>
                <template v-else>
                    <img
                        :class="[typeImageClass]"
                        class="overflow-auto object-cover" id="img-post" :src="`/${access}/${file}`" alt="">
                </template>
                <input id="file" type="file" @change="cambiarImagen" accept="image/*" class="hidden" />
            </label>
        </div>
    </div>
</template>

<style scoped>
</style>