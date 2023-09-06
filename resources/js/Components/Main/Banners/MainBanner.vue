<script setup>
import Container from '@/Components/Main/Containers/Container.vue';

const { user } = defineProps({
    user: {
        type: Object,
    }
});
</script>

<template>
    <div class="w-full h-[60vh] relative overflow-hidden">
        <div class="backdrop-blur-2xl bg-gradient-to-b from-white/80 to-blue-50/10 h-full">
            <Container class="w-full h-full flex items-center">
                <div class="space-y-2">
                    <span class="text-xl font-bold bg-gradient-to-r from-zinc-700 via-indigo-700 to-blue-700 bg-clip-text text-transparent">
                        Hey, my name is
                    </span>
                    <h1 class="text-4xl font-bold uppercase bg-gradient-to-r from-zinc-700 via-indigo-700 to-blue-700 bg-clip-text text-transparent">
                        {{ user.name }}
                    </h1>
                    <h3 class="text-2xl font-bold text-gray-700 dark:text-white">{{ user.position }}</h3>
                </div>
            </Container>
        </div>
        <div class="tk-blob w-64 absolute top-10 right-20 z-[-1]" style="fill: #6b56cb">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 747.2 726.7">
                <path
                    d="M539.8 137.6c98.3 69 183.5 124 203 198.4 19.3 74.4-27.1 168.2-93.8 245-66.8 76.8-153.8 136.6-254.2 144.9-100.6 8.2-214.7-35.1-292.7-122.5S-18.1 384.1 7.4 259.8C33 135.6 126.3 19 228.5 2.2c102.1-16.8 213.2 66.3 311.3 135.4z">
                </path>
            </svg>
        </div>
        <div class="tk-blob w-12 absolute bottom-28 left-20 z-[-1]" style="fill: #0019fd">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 747.2 726.7">
                <path
                    d="M539.8 137.6c98.3 69 183.5 124 203 198.4 19.3 74.4-27.1 168.2-93.8 245-66.8 76.8-153.8 136.6-254.2 144.9-100.6 8.2-214.7-35.1-292.7-122.5S-18.1 384.1 7.4 259.8C33 135.6 126.3 19 228.5 2.2c102.1-16.8 213.2 66.3 311.3 135.4z">
                </path>
            </svg>
        </div>
    </div>
</template>

<style scoped></style>