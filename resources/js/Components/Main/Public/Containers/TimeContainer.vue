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
        <div :class="['grid gap-10', grid]">
            <div v-for="( record, index ) in data" :key="'data-container-' + index"
                class="p-4 space-y-3 border border-[#000000]/[0.16] rounded-xl">
                <time class="text-sm font-medium text-gray-600">
                    <span>{{ record.start_date }} - {{ record.end_date }}</span>
                </time>

                <h3 class="text-lg font-semibold text-gray-700 dark:text-white p-0">
                    {{ record.title }}
                </h3>
                <div class="content-ckeditor">
                    <p :class="['dark:text-gray-400', `line-clamp-${lineClamp}`]" v-html="record.description">
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>