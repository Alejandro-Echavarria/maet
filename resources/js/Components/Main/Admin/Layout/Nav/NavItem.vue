<script setup>
import { computed } from 'vue';
import { Link } from "@inertiajs/vue3";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";

const props = defineProps({
    item: {
        type: Object,
    }
});

const hasActiveChild = computed(() => {
    function hasActiveItem(items) {
        return items.some(item => item.active || hasActiveItem(item.children));
    }

    return hasActiveItem(props.item.children);
});
</script>

<template>
    <Link v-if="!item.children.length" :href="route(item.href)" :class="[
        'flex items-center py-2 px-3 text-sm font-semibold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear',
        { 'bg-indigo-100 text-indigo-700': $page.url.startsWith(item.activeClass) },
    ]">
    <!-- <font-awesome-icon class="w-5 h-5" :icon="['fas', 'chart-line']" /> -->
    <span class="flex-1 ">{{ item.label }}</span>
    </Link>

    <Disclosure v-else v-slot="{ open }" :default-open="hasActiveChild">
        <DisclosureButton :class="[
            'flex w-full text-left items-center py-2 px-3 text-sm font-semibold text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-200 dark:hover:bg-indigo-700 group transition duration-300 ease-linear',
            open ? 'text-indigo-700' : '',
        ]">

            <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z">
                </path>
            </svg>

            <span :class="['flex-1',
                open ? 'text-indigo-700' : '',
            ]">
                {{ item.label }}
            </span>

            <svg :class="['w-5 h-5 shrink-0', open ? '-rotate-180 transition duration-150 ease-linear' : 'rotate-0 transition duration-150 ease-linear']"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z">
                </path>
            </svg>
        </DisclosureButton>
        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-out"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <DisclosurePanel class="ml-4 space-y-2">

                <NavItem v-for="child in item.children" :item="child" />
            </DisclosurePanel>
        </transition>

    </Disclosure>
</template>