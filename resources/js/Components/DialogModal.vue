<script setup>
import Modal from './Modal.vue';

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

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div>
            <div class="text-lg py-4 px-6 font-medium text-gray-700 border-b">
                <div class="flex justify-between">
                    <slot name="title" />
                <button @click="close" class="text-gray-700 bg-gray-200/60 rounded-full w-8 h-8 shrink-0">
                    <font-awesome-icon :class="['w-4 h-4']" :icon="['fas', 'xmark']" />
                </button>
            </div>
            </div>

            <div class="max-h-[65vh] py-4 px-6 text-sm text-gray-600 overflow-y-auto">
                <slot name="content" />
            </div>
        </div>

        <div class="flex flex-row justify-end px-4 py-4 bg-gray-100 text-right">
            <slot name="footer" />
        </div>
    </Modal>
</template>
