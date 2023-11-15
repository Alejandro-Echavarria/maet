<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    tabsOptions: {
        type: Object,
    }
});

const tabs = ref(props.tabsOptions);

onMounted(() => {
    // Simula un cambio de selección a true para demostración
    tabs.value[0].selected = true;
});

const selectTab = (selectedTab) => {
    tabs.value.forEach((tab) => {
        tab.selected = tab === selectedTab;
    });
};
</script>

<template>
    <div>
        <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
            <ul
                class="flex flex-wrap -mb-px text-sm font-medium text-center"
                id="default-tab"
                data-tabs-toggle="#default-tab-content"
                role="tablist"
            >
                <li
                    v-for="tab in tabs"
                    :key="tab.id"
                    class="me-2"
                    role="presentation"
                >
                    <button
                        :class="{
                            'inline-block p-4 border-b-2 rounded-t-lg transition ease-in-out duration-300': true,
                            'text-indigo-700 font-bold hover:text-indigo-600 dark:text-indigo-500 dark:hover:text-indigo-400 border-indigo-700 dark:border-indigo-700':
                                tab.selected,
                            'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-gray-700':
                                !tab.selected,
                        }"
                        :id="`${tab.id}-tab`"
                        :data-tabs-target="`#${tab.id}`"
                        type="button"
                        role="tab"
                        :aria-controls="tab.id"
                        :aria-selected="tab.selected.toString()"
                        @click="selectTab(tab)"
                    >
                        {{ tab.label }}
                    </button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div
                v-for="tab in tabs"
                :key="tab.id"
                class="hidden"
                :id="tab.id"
                role="tabpanel"
                :aria-labelledby="`${tab.id}-tab`"
            >
                <slot :name="`tab${tab.id}`" />
            </div>
        </div>
    </div>
</template>
