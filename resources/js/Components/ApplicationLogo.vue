<script setup>
const props = defineProps({
    class: {
        type: String,
        default: 'w-8 h-8'
    }
})
</script>

<template>
    <img src="/img/icon/my-icon.png" alt="MAET Logo" :class="class">
</template>
