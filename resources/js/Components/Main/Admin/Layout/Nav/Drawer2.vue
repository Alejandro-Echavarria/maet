<script setup>
import { ref, onMounted, onBeforeUnmount, watchEffect } from 'vue';

const { isOpen } = defineProps(['isOpen']);
const shouldShowComponent = ref(false);

const handleResize = () => {
    shouldShowComponent.value = window.innerWidth < 1024;
};

onMounted(() => {
    // Verificar el tamaño de la pantalla al cargar el componente
    handleResize();
    // Agregar un listener para manejar cambios en el tamaño de la pantalla
    window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
    // Eliminar el listener cuando se desmonta el componente
    window.removeEventListener('resize', handleResize);
});

// Actualizar shouldShowComponent cuando cambia isOpen
watchEffect(() => {
    handleResize();
});
</script>

<template>
    <div v-if="shouldShowComponent && isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-30" />
</template>
