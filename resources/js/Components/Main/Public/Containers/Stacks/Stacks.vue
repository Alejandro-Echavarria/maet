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
                    <div id="tech-container" v-for="stack in stacks" :key="stack.id"
                        :class="['text-sm font-semibold text-indigo-700', stacks.length <= 3 && 'w-full justify-between']">
                        <div class="flex justify-center mx-1">
                            <div class="overflow-hidden">
                                <i v-html="stack.icon" :title="stack.name" />
                            </div>
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
