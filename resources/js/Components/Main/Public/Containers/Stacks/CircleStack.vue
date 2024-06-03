<template>
    <!--
        Inspirado por Darley
        https://uiverse.io/Darlley/unlucky-mouse-37
    -->
    <div class="relative h-full w-full flex items-center justify-center">
        <div class="border-[#000000]/[0.16] bg-white/40 backdrop-blur-sm border  w-auto rounded-full flex items-center justify-center py-1 px-4">
            <p class="text-sm  font-semibold text-gray-500">
                Main tech
            </p>
        </div>

        <div v-for="(tech, index) in techStack" :key="'tech-' + index" class="animate-fade-in"
            :style="{ animationDelay: `${index * 0.30}s` }"
            @mouseover="pauseAnimation(index)"
            @mouseleave="resumeAnimation(index)" @click="toggleAnimation(index)" @touchstart="toggleAnimation(index)">
            <div :id="'tech-' + index"
                class="stack-container shadow-gray-500/10 shadow-md absolute rounded-full bg-cover cursor-pointer border border-[#000000]/[0.16] bg-white backdrop-blur-sm transition-all duration-500"
                :style="calculatePosition(index, techStack.length)">
                <HoverTooltip :content="tech.name">
                    <span
                        class="block w-[30px] h-[30px] sm:w-[40px] sm:h-[40px] transition-all duration-500 rounded-full z-[2] overflow-hidden">
                        <div class="overflow-hidden flex items-center justify-center h-full">
                            <i v-html="tech.icon" :title="tech.name" />
                        </div>
                    </span>
                </HoverTooltip>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import HoverTooltip from '@/Components/Main/Public/Components/Tooltips/HoverTooltip.vue';

const props = defineProps({
    stacks: Object
});

const techStack = ref(props.stacks);
const mobileRadius = 30;
const desktopRadius = 40;

const radius = computed(() => {
    return window.innerWidth <= 640 ? mobileRadius : desktopRadius;
});

const calculatePosition = (index, total) => {
    const angle = (index / total) * 2 * Math.PI;
    const x = Math.cos(angle) * radius.value;
    const y = Math.sin(angle) * radius.value;
    const animationDuration = (index + 3) * 1;
    return {
        left: `calc(50% + ${x}px)`,
        top: `calc(50% + ${y}px)`,
        animation: `orbit ${animationDuration}s linear infinite`
    };
};

const pauseAnimation = (index) => {
    const element = document.querySelector(`#tech-${index}`);
    if (element) {
        element.style.animationPlayState = 'paused';
    }
};

const resumeAnimation = (index) => {
    const element = document.querySelector(`#tech-${index}`);
    if (element) {
        element.style.animationPlayState = 'running';
    }
};

const toggleAnimation = (index) => {
    const element = document.querySelector(`#tech-${index}`);
    if (element) {
        element.style.animationPlayState = element.style.animationPlayState === 'paused' ? 'running' : 'paused';
    }
};

onMounted(() => {
    window.addEventListener('resize', () => {
        calculatePosition();
    });
});
</script>

<style>
div.stack-container svg {
    width: 25px;
    height: 25px;
}

@keyframes orbit {
    0% {
        transform: rotate(0deg) translateX(60px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(60px) rotate(-360deg);
    }
}

.stack-container {
    transition: animation-play-state 0.3s;
}
</style>
