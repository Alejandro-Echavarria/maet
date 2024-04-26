<script setup>
import { Vue3Marquee } from 'vue3-marquee';

const props = defineProps({
    title: {
        type: String,
        default: 'Tech'
    },
    stacks: {
        type: Object,
    },
    placement: {
        type: String,
        default: '-bottom-4'
    }
});
</script>

<template>
    <div v-if="stacks.length" class="relative mx-2">
        <div :class="['flex absolute justify-center inset-x-0', placement]">
            <div
                class="p-1 w-3/4 flex text-xs items-center font-semibold rounded-xl border backdrop-blur-md bg-white/50 shadow-gray-500/20 shadow-sm border-[#000000]/[0.16]">
                <div :class="[title !== 'Tech' ? 'w-28 sm:w-24' : 'w-14 lg:w-10', 'pl-1 overflow-hidden flex items-center']">
                    <p class="truncate">
                        {{ `${title}:` }}
                    </p>
                </div>
                <template v-if="stacks.length">
                    <Vue3Marquee :pause="stacks.length <= 3" :pause-on-hover="true">
                        <div id="tech-container" v-for="stack in stacks" :key="stack.id"
                            :class="['text-sm font-semibold text-gray-800', stacks.length <= 3 && 'w-full justify-between']">
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
                </template>
            </div>
        </div>
    </div>
</template>
