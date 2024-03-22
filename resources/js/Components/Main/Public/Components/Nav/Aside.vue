<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    items: Object
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
    // isBackDropVisible.value = window.innerWidth < 1024;

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
    });
};

defineExpose({ toggleSidebarVisibility });
</script>

<template>
    <aside
        :class="['sidebar', { 'collapsed': !isSidebarVisible }, { 'border-r border-[#000000]/[0.16]': isSidebarVisible }]"
        class="z-30 bg-white text-gray-800 absolute dark:text-gray-200 dark:bg-gray-800 dark:border-gray-700 shrink-0">
        <div>
            <template v-for="(item, index) in items">
                <h2 class="text-xl font-bold">{{ index }}</h2>
                <ul class="my-4 space-y-2">
                    <li @click="filter(item.model, data.slug)" v-for="data in item.items" :key="'category-' + data.id"
                        class="hover:text-indigo-700 cursor-pointer">
                        {{ data.name }}
                    </li>
                </ul>
            </template>
        </div>
    </aside>
</template>

<style scoped>
.sidebar {
    width: 11rem;
    transition: width 0.3s ease;
    overflow: hidden;
}

.sidebar.collapsed {
    width: 0;
}

.sidebar-transition-enter-active,
.sidebar-transition-leave-active {
    transition: width 0.3s ease;
}

.sidebar-transition-enter,
.sidebar-transition-leave-to {
    width: 0;
}

.sidebar-menu {
    opacity: 1;
    transition: opacity 0.3s ease;
}

.sidebar.collapsed .sidebar-menu {
    opacity: 0;
}
</style>