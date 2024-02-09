<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    modelValue: String,
    inlineStyle: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue']);
const open = ref(false);
const currentColor = ref(props.modelValue);
const colors = [
    "gray",
    "slate",
    "pink",
    "red",
    "orange",
    "yellow",
    "green",
    "teal",
    "blue",
    "indigo",
    "purple",
];
const variants = [100, 200, 300, 400, 500, 600, 700, 800, 900];
const iconColor = ref('text-gray-700');
const regex = /^([a-z]+)-(\d+)$/;
const baseColor = ref(null);
const shade = ref(null);

onMounted(() => {
    const result = splitColor(props.modelValue);

    if (result) {
        baseColor.value = result.base;
        shade.value = parseInt(result.shadeValue);

        if (shade.value > 500) {
            iconColor.value = 'text-gray-200';
        }
    }
});

const selectColor = (color, variant) => {
    currentColor.value = `${color}-${variant}`;

    emit('update:modelValue', currentColor.value);

    if (variant < 500) {
        setIconBlack();
    } else {
        setIconWhite();
    }

    open.value = false;
};

const setIconWhite = () => {
    iconColor.value = 'text-gray-100';
};

const setIconBlack = () => {
    iconColor.value = 'text-gray-700';
};

const splitColor = (color) => {
    const matches = color.match(regex);

    if (matches && matches.length === 3) {
        const [, base, shadeValue] = matches;
        return { base, shadeValue };
    }
    return null; // Manejar el caso en el que la cadena no coincida con el formato esperado
};
</script>

<template>
    <div class="relative">
        <!-- Full Screen Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false" />

        <div class="flex flex-row w-full justify-between items-center">
            <div class="w-full mr-2">
                <span
                    :class="[
                        inlineStyle
                        ? 'cursor-pointer block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-indigo-700 focus:border-indigo-700 peer transition'
                        : 'cursor-pointer block mt-2 pl-3 w-full rounded-lg border-0 py-1.5 text-gray-700 ring-1 ring-inset ring-gray-300 dark:text-gray-400 dark:border-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-700 sm:text-sm sm:leading-6 transition'
                    ]"
                    @click="open = true">
                    {{ currentColor }}
                </span>
            </div>
            <div @click="open = !open"
                :class="['cursor-pointer rounded-full my-auto h-8 w-8 flex shrink-0', `bg-${currentColor}`, !inlineStyle && 'mt-2']">
                <svg xmlns="http://www.w3.org/2000/svg" :class="['h-5 w-5 mx-auto my-auto', iconColor]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
            </div>
        </div>

        <transition name="fade">
            <div v-show="open"
                class="z-50 absolute origin-top-right right-0 mt-2 rounded-xl shadow-lg max-w-xs sm:max-w-md">
                <div class="rounded-xl bg-white shadow-xs p-2 z-10 border overflow-auto w-[17rem] sm:w-full h-32">
                    <div class="flex">
                        <template v-for="color in colors">
                            <div>
                                <template v-for="variant in variants">
                                    <div class="relative">
                                        <span v-if="currentColor === `${color}-${variant}`"
                                            class="absolute justify-center items-center inset-0 flex">
                                            <font-awesome-icon :class="['w-4 h-4', { 'text-gray-200': variant > 400 }]" :icon="['fas', 'xmark']" />
                                        </span>
                                        <div @click="selectColor(color, variant)" :class="[
                                            'cursor-pointer w-6 h-6 rounded-md mx-1 my-1',
                                            `bg-${color}-${variant}`,
                                        ]">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
  

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>