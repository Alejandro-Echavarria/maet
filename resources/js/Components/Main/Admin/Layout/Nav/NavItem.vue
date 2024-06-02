<script setup>
import { computed, ref } from 'vue';
import { Link } from "@inertiajs/vue3";
import { Disclosure, DisclosureButton, DisclosurePanel, TransitionRoot } from "@headlessui/vue";

const props = defineProps({
    item: {
        type: Object,
    }
});

const isShowing = ref(true);
const emit = defineEmits(['click']);

const hasActiveChild = computed(() => {
    function hasActiveItem(items) {
        return items.some(item => item.active || hasActiveItem(item.children));
    }

    return hasActiveItem(props.item.children);
});

const toggleSidebarVisibility = () => {
    emit("click");
}
</script>

<template>
    <TransitionRoot class="space-y-2" appear :show="isShowing" enter="transition-opacity duration-75" enter-from="opacity-0"
        enter-to="opacity-100" leave="transition-opacity duration-300" leave-from="opacity-100" leave-to="opacity-0">
        <Link v-if="!item.children.length && item.visible === true" :href="route(item.href)" @click="toggleSidebarVisibility" :class="[
            'flex whitespace-nowrap items-center py-2 px-3 text-sm font-semibold text-gray-800 rounded-lg dark:text-gray-200 hover:bg-indigo-700/10 dark:hover:bg-indigo-700 group transition duration-200 ease-linear',
            { 'bg-indigo-700/10 text-indigo-700': $page.url.startsWith(item.activeClass) },
        ]">
        <span class="flex-1">
            <template v-if="item.icon">
                <font-awesome-icon class="w-4 h-4 mr-2" :icon="item.icon" />
            </template>
            {{ item.label }}
        </span>
        </Link>
        <Disclosure v-else-if="item.visible === true" v-slot="{ open }" :default-open="hasActiveChild">
            <DisclosureButton :class="[
                'flex w-full whitespace-nowrap text-left items-center py-2 px-3 text-sm font-semibold text-gray-800 rounded-lg dark:text-gray-200 hover:bg-indigo-700/10 dark:hover:bg-indigo-700 group transition duration-200 ease-linear',
                open ? 'text-indigo-700' : '',
            ]">
                <span :class="['flex-1',
                    open ? 'text-indigo-700' : '',
                ]">
                    <template v-if="item.icon">
                        <font-awesome-icon class="w-4 h-4 mr-2" :icon="item.icon" />
                    </template>
                    {{ item.label }}
                </span>

                <svg :class="['w-5 h-5 shrink-0', open ? '-rotate-0 transition duration-150 ease-linear' : '-rotate-90 transition duration-150 ease-linear']"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z">
                    </path>
                </svg>
            </DisclosureButton>
            <transition enter-active-class="transition duration-150 ease-out"
                enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-out" leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0">
                <DisclosurePanel class="ml-4 pl-2 space-y-2 border-l border-gray-200">
                    <NavItem v-for="child in item.children" :item="child" @click="toggleSidebarVisibility" />
                </DisclosurePanel>
            </transition>
        </Disclosure>
    </TransitionRoot>
</template>