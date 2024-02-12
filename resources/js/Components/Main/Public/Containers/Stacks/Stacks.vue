<script setup>
import { Vue3Marquee } from 'vue3-marquee';

const props = defineProps({
    stacks: {
        type: Object,
    }
});

</script>

<template>
    <div class="relative mx-2">
        <div class="absolute inset-x-0 bottom-2 bg-white/50 w-full rounded-xl shadow-gray-500/20 shadow-sm">
            <div class="p-1 rounded-md border backdrop-blur-md border-[#000000]/[0.16]">
                <Vue3Marquee>
                    <div v-for="stack in stacks" :key="stack.id" class="flex gap-x-2 text-sm font-bold text-indigo-700">
                        <div class="ml-2">
                            <img v-if="stack.link_icon" class="w-5" :src="stack.link_icon" :alt="stack.name">
                        </div>
                        <p>
                            {{ stack.name }}
                        </p>
                    </div>
                </Vue3Marquee>
            </div>
        </div>
    </div>
</template>
