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
        <div class="flex absolute justify-center inset-x-0 -bottom-4">
            <div
                class="p-1 w-3/4 flex text-xs items-center font-semibold rounded-xl border backdrop-blur-md bg-white/50 shadow-gray-500/20 shadow-sm border-[#000000]/[0.16]">
                <div class="px-2">
                    <span>
                        Tech:
                    </span>
                </div>
                <Vue3Marquee :pause="stacks.length <= 3" :pause-on-hover="true">
                    <div v-for="stack in stacks" :key="stack.id"
                        :class="['text-sm font-bold text-indigo-700', stacks.length <= 3 && 'w-full justify-between']">
                        <div class="flex justify-center mx-1">
                            <img v-if="stack.link_icon" class="w-5 h-full" :src="stack.link_icon" :alt="stack.name">
                            <p class="mx-1">
                                {{ stack.name }}
                            </p>
                        </div>
                    </div>
                </Vue3Marquee>
            </div>
        </div>
    </div>
</template>
