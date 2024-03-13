<script setup>
const props = defineProps({
    data: {
        type: Object,
        required: true
    },
    lineClamp: {
        type: Number,
        default: 0
    },
    grid: {
        type: String,
        default: 'grid-cols-1'
    }
});
</script>

<template>
    <div>
        <div class="p-4 space-y-3 border border-[#000000]/[0.16] rounded-xl">

            <template v-if="$slots.title">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-white p-0">
                    <slot name="title" />
                </h3>
            </template>

            <template v-if="$slots.description">
                <div class="content-ckeditor">
                    <p :class="['dark:text-gray-400', `line-clamp-${lineClamp}`]" v-html="record.description">
                    </p>
                </div>
            </template>
        </div>
    </div>
</template>