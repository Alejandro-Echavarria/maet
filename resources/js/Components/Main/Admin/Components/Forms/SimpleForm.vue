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
        <div v-if="actions" class="mt-6 w-full flex justify-end">
            <slot name="actions" />
        </div>
    </form>
</template>