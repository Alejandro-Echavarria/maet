<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block w-full pl-3 pr-4 py-2 text-left text-3xl font-semibold text-indigo-700 focus:outline-none focus:text-indigo-800 transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 text-left text-3xl font-semibold text-gray-800 hover:text-gray-800 focus:outline-none focus:text-gray-800 transition duration-150 ease-in-out';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
