<script setup>
defineProps({
    actions: {
        type: Boolean,
    }
});

defineEmits(['submitted']);
</script>

<template>
    <form id="simpleForm" @submit.prevent="$emit('submitted')" classs="space-y-6">
        <div>
            <slot name="form" />
        </div>
        <div v-if="actions" class="w-full flex justify-end">
            <slot name="actions" />
        </div>
    </form>
</template>