<script setup>
const props = defineProps({
    name: String,
    image: {
        type: Object
    },
    color: {
        type: String,
        default: '7F9CF5'
    },
    background: {
        type: String,
        default: 'EBF4FF'
    },
    class: {
        type: String,
        default: 'w-8 h-8 rounded-full'
    }
});
</script>

<template>
    <img :class="class" class="object-cover" :src="image
        ? `/admin/${image}`
        : `https://ui-avatars.com/api/?name=${name}&color=${color}&background=${background}`"
        :alt="'profile-image-' + name">
</template>