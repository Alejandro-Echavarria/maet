<template>
    <div class="relative h-full w-full flex items-center justify-center">
        <div
            class="profileCard_container relative p-10 border-2 border-dashed rounded-full border-spacing-4 border-gray-400/50">
            <div class="main-stack absolute text-center font-bold text-xl">
                Main Stack
            </div>
            <button v-for="(tech, index) in techStack" :key="tech.id"
                :style="calculatePosition(index, techStack.length)"
                class="profile_item absolute rounded-full bg-cover cursor-pointer border border-gray-400/50 p-[2px] active:scale-95 hover:scale-95 transition-all duration-500">
                <span
                    class="block w-[40px] h-[40px] transition-all duration-500 rounded-full z-[2] bg-white p-1 animate-spin">
                    <svg :viewBox="tech.viewBox" xmlns="http://www.w3.org/2000/svg">
                        <path :d="tech.path" :fill="tech.fill"></path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            techStack: [
                {
                    id: 1,
                    viewBox: '0 0 128 128',
                    path: 'M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3c...5.5z',
                    fill: '#61DAFB'
                },
                {
                    id: 1,
                    viewBox: '0 0 128 128',
                    path: 'M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3c...5.5z',
                    fill: '#61DAFB'
                },
                {
                    id: 1,
                    viewBox: '0 0 128 128',
                    path: 'M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3c...5.5z',
                    fill: '#61DAFB'
                },
                {
                    id: 1,
                    viewBox: '0 0 128 128',
                    path: 'M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3c...5.5z',
                    fill: '#61DAFB'
                },
                {
                    id: 1,
                    viewBox: '0 0 128 128',
                    path: 'M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3c...5.5z',
                    fill: '#61DAFB'
                },
                {
                    id: 1,
                    viewBox: '0 0 128 128',
                    path: 'M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3c...5.5z',
                    fill: '#61DAFB'
                },
                // Añade más objetos de tecnología aquí si es necesario...
            ]
        };
    },
    methods: {
        calculatePosition(index, total) {
            const angle = (index / total) * 2 * Math.PI;
            const radius = 80; // Ajusta el radio según tus necesidades
            const x = Math.cos(angle) * radius;
            const y = Math.sin(angle) * radius;
            return {
                left: `calc(50% + ${x}px)`,
                top: `calc(50% + ${y}px)`,
                animation: `orbit ${index + 3}s linear infinite`
            };
        }
    }
};
</script>

<style>
.profile_item {
    width: 48px;
    height: 48px;
    transform: translate(-50%, -50%);
}

.main-stack {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes orbit {
    0% {
        transform: rotate(0deg) translateX(80px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(80px) rotate(-360deg);
    }
}
</style>