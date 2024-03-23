<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    items: Object,
});

const isSidebarVisible = ref(true);

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
});

const toggleSidebarVisibility = () => {
    if (window.innerWidth < 1490) {
        isSidebarVisible.value = !isSidebarVisible.value;
        document.body.classList.toggle('overflow-hidden', isSidebarVisible.value);
    }
};

const handleResize = () => {
    isSidebarVisible.value = window.innerWidth >= 1490; // Cambiar 1024 por el ancho de resolución deseado para ocultar el sidebar

    if (window.innerWidth > 1490) {
        document.body.classList.toggle('overflow-hidden', false);
    }
};

const filter = (model, value) => {
    router.visit(router.page.url, {
        preserveScroll: false,
        preserveState: true,
        data: {
            [model]: value,
        },
        onFinish: () => {
            toggleSidebarVisibility();
        }
    });
};

const activeFilter = (model, value) => {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has(model)) {
        if (urlParams.get(model) === value) {
            return true;
        }
    }
};

const clearFilter = (model) => {
    router.visit(router.page.url, {
        preserveScroll: false,
        preserveState: true,
        data: {
            [model]: null,
        },
        onFinish: () => {
            toggleSidebarVisibility();
        }
    });
};

defineExpose({ toggleSidebarVisibility });
</script>

<template>
    <aside
        :class="['sidebar max-[1490px]:shadow-gray-500/20 max-[1490px]:shadow-lg max-[1490px]:rounded-b-xl max-[1490px]:w-[100%] h-full max-h-[70vh] overflow-y-auto w-[11rem] max-[1490px]:justify-center max-[1490px]:text-center', { 'collapsed': !isSidebarVisible }, { 'border-r border-[#000000]/[0.16] pb-4': isSidebarVisible }]"
        class="z-30 bg-white text-gray-800 absolute max-[1490px]:left-0 dark:text-gray-200 dark:bg-gray-800 dark:border-gray-700 shrink-0">
        <div :class="{ 'hidden': !isSidebarVisible }, 'h-auto'">
            <template v-for="(item, index) in items">
                <h2 class="text-xl font-bold">{{ index }}</h2>
                <ul class="my-4 space-y-2">
                    <li @click="filter(item.model, data.slug)" v-for="(data, index) in item.items"
                        :key="'category-' + data.id" :class="activeFilter(item.model, data.slug) && 'text-indigo-700'"
                        class="font-medium hover:text-indigo-700 cursor-pointer animate-fade-in"
                        :style="{ animationDelay: `${index * 0.05}s` }">
                        {{ data.name }}
                    </li>
                    <li @click="clearFilter(item.model)"
                        class=" font-medium hover:text-indigo-700 cursor-pointer animate-fade-in">
                        Clear filter
                    </li>
                </ul>
            </template>
        </div>
    </aside>
</template>

<style scoped>
.sidebar {
    transition: height 0.3s ease;
}

.sidebar.collapsed {
    height: 0;
}

.sidebar-transition-enter-active,
.sidebar-transition-leave-active {
    transition: height 0.3s ease;
}

.sidebar-transition-enter,
.sidebar-transition-leave-to {
    height: 0;
}

.sidebar-menu {
    opacity: 1;
    transition: opacity 0.3s ease;
}

.sidebar.collapsed .sidebar-menu {
    opacity: 0;
}
</style>