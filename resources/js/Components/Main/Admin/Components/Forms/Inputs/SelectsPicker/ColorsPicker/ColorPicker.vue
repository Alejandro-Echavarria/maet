<script setup>
import { ref } from "vue";
import TextInput from '@/Components/TextInput.vue';

const isOpen = ref(false);
const currentColor = ref('gray-100');
const colors = ["gray", "slate", "red", "orange", "yellow", "green", "blue", "indigo", "purple", "pink"];
const variants = [100, 200, 300, 400, 500, 600];

const selectColor = (color, variant) => {
    currentColor.value = `${color}-${variant}`;
};


</script>

<template>
    <div>
        <div class="flex flex-row relative">
            <TextInput />
            <div @click="isOpen = !isOpen" class="cursor-pointer rounded-full ml-3 my-auto h-10 w-10 flex"
                :class="`bg-${currentColor}`">
                <svg xmlns="http://www.w3.org/2000/svg" :class="`${iconColor}`" class="h-6 w-6 mx-auto my-auto" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
            </div>
        </div>
        <transition name="fade">
            <div v-show="isOpen" class="z-10 absolute right-2 mt-2 rounded-xl shadow-lg max-w-xs sm:max-w-md">
                <div class="rounded-xl bg-white shadow-xs p-2 z-10 border overflow-auto w-auto">
                    <div class="flex">
                        <template v-for="color in colors">
                            <div>
                                <template v-for="variant in variants">
                                    <div @click="selectColor(color, variant)"
                                        class="cursor-pointer w-6 h-6 rounded-md mx-1 my-1"
                                        :class="`bg-${color}-${variant}`"></div>
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