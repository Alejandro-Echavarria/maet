<script setup>
import Modal from './Modal.vue';
import { ref } from 'vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const fullScreen = ref(false);

const fullScreenToggle = () => {
    fullScreen.value = !fullScreen.value;
};

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal :show="show" :max-width="fullScreen ? 'full' : maxWidth" :closeable="closeable" @close="close">
        <div :class="fullScreen && 'max-w-6xl mx-auto'">
            <div :class="fullScreen ? 'border rounded-b-xl py-2' : 'border-b py-4'" class="text-lg px-4 sm:px-6 font-medium">
                <div class="flex justify-between">
                    <slot name="title" />

                    <div class="flex gap-4">
                        <button @click="fullScreenToggle"
                            class="text-gray-700 rounded-full w-8 h-8 shrink-0 flex items-center justify-center">
                            <svg v-if="fullScreen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-window-minimize w-5 h-5 text-indigo-700">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 16m0 1a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1z" />
                                <path d="M4 12v-6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6" />
                                <path d="M15 13h-4v-4" />
                                <path d="M11 13l5 -5" />
                            </svg>

                            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-window-maximize w-5 h-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 16m0 1a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1z" />
                                <path d="M4 12v-6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6" />
                                <path d="M12 8h4v4" />
                                <path d="M16 8l-5 5" />
                            </svg>
                        </button>

                        <button @click="close"
                            class="text-gray-700 bg-gray-200/60 rounded-full w-8 h-8 shrink-0 flex items-center justify-center">
                            <font-awesome-icon :class="['w-4 h-4']" :icon="['fas', 'xmark']" />
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden">
                <div :class="fullScreen ? 'h-[calc(100vh-100px)]' : 'max-h-[65vh]'"
                    class="py-4 px-4 sm:px-6 text-sm text-gray-600 overflow-y-auto">
                    <slot name="content" />
                </div>
            </div>

            <div :class="fullScreen ? 'rounded-t-xl py-2' : 'py-4'"
                class="flex flex-row justify-end px-4 bg-gray-100 sm:px-6 text-right">
                <slot name="footer" />
            </div>
        </div>
    </Modal>
</template>
