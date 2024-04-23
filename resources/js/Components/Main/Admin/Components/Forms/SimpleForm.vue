<script setup>
defineProps({
    actions: {
        type: Boolean,
    }
});

defineEmits(['submitted']);
</script>

<template>
    <form id="simpleForm" @submit.prevent="$emit('submitted')">
        <div>
            <slot name="form" />
        </div>
        <div v-if="actions" class="w-full flex justify-end mt-6">
            <slot name="actions" />
        </div>
    </form>
</template>