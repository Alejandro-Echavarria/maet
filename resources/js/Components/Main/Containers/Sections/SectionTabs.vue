<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    tabsOptions: {
        type: Object,
    }
});

const defaultTabs = ref([
    { id: "education", label: "Educations", route: 'admin.resume.educations.index' },
    { id: "experience", label: "Experiences", route: 'admin.resume.experiences.index' },
    // { id: "job", label: "Jobs", route: 'admin.resume.experiences.index', selected: false },
    // { id: "workingSkill", label: "Working Skills", route: 'admin.resume.experiences.index', selected: false },
    // { id: "know", label: "Knows", route: 'admin.resume.experiences.index', selected: false },
]);

const tabs = props.tabsOptions ? ref(props.tabsOptions) : defaultTabs;
</script>

<template>
    <div>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li v-for="tab in tabs" :key="tab.id" class="me-2">
                    <Link :href="route(tab.route)" preserve-scroll preserve-state>
                    <button :class="{
                        'inline-block p-4 border-b-2 rounded-t-lg transition ease-in-out duration-300': true,
                        'text-indigo-700 font-bold hover:text-indigo-600 dark:text-indigo-500 dark:hover:text-indigo-400 border-indigo-700 dark:border-indigo-700':
                            route().current(tab.route),
                        'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-gray-700':
                            !route().current(tab.route),
                    }" :id="`${tab.id}-tab`" type="button">
                        {{ tab.label }}
                    </button>
                    </Link>
                </li>
            </ul>
        </div>
        <div>
            <div v-for="tab in tabs" :key="tab.id" :id="tab.id">
                <slot :name="`tab${tab.id}`" />
            </div>
        </div>
    </div>
</template>
