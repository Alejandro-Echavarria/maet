<script setup>
import { computed } from 'vue';

const props = defineProps({
    errors: {
        type: Object,
        default: null,
        required: true,
    },
});

const checkErrors = computed(() => Object.keys(props.errors).length);
</script>

<template>
    <div class="shrink-0 mr-3" :class="checkErrors > 0 ? 'flex' : 'hidden'"
        :title="'Existen ' + checkErrors + ' errores'">
        <div class="bg-gray-200 h-full p-2 rounded-full flex items-center">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 animate-pulse" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 1.67c.955 0 1.845.467 2.39 1.247l.105.16l8.114 13.548a2.914 2.914 0 0 1-2.307 4.363l-.195.008H3.882a2.914 2.914 0 0 1-2.582-4.2l.099-.185l8.11-13.538A2.914 2.914 0 0 1 12 1.67M12.01 15l-.127.007a1 1 0 0 0 0 1.986L12 17l.127-.007a1 1 0 0 0 0-1.986zM12 8a1 1 0 0 0-.993.883L11 9v4l.007.117a1 1 0 0 0 1.986 0L13 13V9l-.007-.117A1 1 0 0 0 12 8" />
                </svg>
            </span>
        </div>
    </div>
</template>