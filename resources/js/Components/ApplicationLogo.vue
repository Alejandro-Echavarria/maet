<script setup>
const props = defineProps({
    class: {
        type: String,
        default: 'w-10 h-10'
    }
})
</script>

<template>
    <img src="/img/icon/my-icon.png" alt="MAET Logo" :class="class">
</template>
