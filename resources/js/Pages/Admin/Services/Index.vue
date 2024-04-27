<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import SaveService from '@/Pages/Admin/Services/Partials/SaveService.vue';
import DeleteService from '@/Pages/Admin/Services/Partials/DeleteService.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    services: Object,
    filter: String,
    page: String
});

const thead = ['title', 'icon', 'color', 'created', 'updated'];
const url = 'admin.services.index';
const callOpenModal = ref(null);

const openModal = (op, id, name, icon, description, color) => {
    callOpenModal.value.openModal(op, id, name, icon, description, color);
};
</script>

<template>

    <Head title="Services" />

    <div>
        <MainTitle>
            Services
        </MainTitle>
        <!-- <Transition name="card" appear enter="transition-opacity duration-75" enter-from="opacity-0"
            enter-to="opacity-100" leave="transition-opacity duration-300" leave-from="opacity-100" leave-to="opacity-0">
        </Transition> -->
        <MainTable :pagination="services">
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>

            <template #createButton>
                <SaveService ref="callOpenModal" :data="services" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="(tb, index) in services.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300 animate-fade-in-down"
                    :key="tb.id + 'tb'" :style="{ animationDelay: `${index * 0.05}s` }">
                    <td class="px-4 py-3">{{ tb.name }}</td>
                    <td class="px-4 py-3">{{ tb.icon }}</td>
                    <td class="px-4 py-3">{{ tb.color }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.name, tb.icon, tb.description, tb.color)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <DeleteService :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'" />
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>

<style scoped>
.card-move,
.card-enter-active,
.card-leave-active {
    transition: 0.35s ease;
}

.card-enter-from,
.card-leave-to {
    opacity: 0;
    transform: translateY(10px);
}
</style>