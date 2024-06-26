<script setup>
import { ref, onMounted, onUnmounted, computed, watch } from 'vue';
import HoverTooltip from '@/Components/Main/Public/Components/ToolTips/HoverTooltip.vue';
import ButtonTooltip from '@/Components/Main/Public/Components/ToolTips/ButtonTooltip.vue';

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
    const animationDuration = (index === 0 ? 5 : index + 3) * 1;

    return {
        left: `calc(50% + ${x}px)`,
        top: `calc(50% + ${y}px)`,
        animation: `orbit ${animationDuration}s linear infinite`
    };
};

const pauseAnimation = (index) => {
    const element = document.querySelector(`#tech-${index}`);
    if (element && window.innerWidth >= 640) {
        element.style.animationPlayState = 'paused';
    }
};

const resumeAnimation = (index) => {
    const element = document.querySelector(`#tech-${index}`);
    if (element && window.innerWidth >= 640) {
        element.style.animationPlayState = 'running';
    }
};

const toggleAnimation = (index) => {
    const element = document.querySelector(`#tech-${index}`);
    if (element) {
        element.style.animationPlayState = element.style.animationPlayState === 'paused' ? 'running' : 'paused';
    }
};

// Estado reactivo para el componente de tooltip
const tooltipComponent = ref(window.innerWidth <= 640 ? ButtonTooltip : HoverTooltip);

// Función para actualizar el componente de tooltip según el tamaño de la pantalla
const updateTooltipComponent = () => {
    tooltipComponent.value = window.innerWidth <= 640 ? ButtonTooltip : HoverTooltip;
};

// Observa los cambios en el tamaño de la ventana y actualiza el componente de tooltip
watch(() => window.innerWidth, updateTooltipComponent);

// Agrega un event listener para el cambio de tamaño de la ventana
onMounted(() => {
    window.addEventListener('resize', updateTooltipComponent);
});

// Limpia el event listener cuando el componente se desmonta
onUnmounted(() => {
    window.removeEventListener('resize', updateTooltipComponent);
});
</script>

<template>
    <div class="relative h-full w-full flex items-center justify-center">
        <div
            class="border-[#000000]/[0.16] bg-white/40 backdrop-blur-sm border w-auto rounded-full flex items-center justify-center py-1 px-4">
            <ButtonTooltip :content="'Hey!'">
                <p class="text-sm font-semibold text-gray-500">
                    Main tech
                </p>
            </ButtonTooltip>
        </div>

        <div v-for="(tech, index) in techStack" :key="'tech-' + index" class="animate-fade-in"
            :style="{ animationDelay: `${index * 0.30}s` }" @mouseover="pauseAnimation(index)"
            @mouseleave="resumeAnimation(index)" @click="toggleAnimation(index)">
            <div :id="'tech-' + index"
                class="stack-container shadow-gray-500/10 shadow-md absolute rounded-full bg-cover cursor-pointer border border-[#000000]/[0.16] bg-white backdrop-blur-sm transition-all duration-500"
                :style="calculatePosition(index, techStack.length)">
                <component :is="tooltipComponent" :content="tech.name">
                    <span
                        class="block w-[30px] h-[30px] sm:w-[40px] sm:h-[40px] transition-all duration-500 rounded-full z-[2] overflow-hidden">
                        <div class="overflow-hidden flex items-center justify-center h-full">
                            <i v-html="tech.icon" :title="tech.name" />
                        </div>
                    </span>
                </component>
            </div>
        </div>
    </div>
</template>

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
  