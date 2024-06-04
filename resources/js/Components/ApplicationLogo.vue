<script setup>
const props = defineProps({
    class: {
        type: String,
        default: 'w-8 h-8'
    },
    entityName: {
        type: String,
    },
    access: {
        type: String,
        default: 'storage',
    },
    url: {
        type: String,
    }
})
</script>

<template>
    <img :src="`/${access}/${url}`" :alt="`${entityName} Logo`" :class="class">
</template>
