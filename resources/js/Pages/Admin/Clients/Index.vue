<script setup>
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import SaveClient from '@/Pages/Admin/Clients/Partials/SaveClient.vue';

defineOptions({
    layout: MainLayout,
});

const props = defineProps({
    clients: {
        type: Object,
        required: true,
    },
    filter: String,
    page: String
});

const thead = ['photo', 'First name', 'last name', 'email', 'phone', 'country'];
const url = 'admin.clients.index';
const callOpenModal = ref(null);

const openModal = (op, id, name, icon, main) => {
    callOpenModal.value.openModal(op, id, name, icon, main);
};
</script>

<template>
    <div>

        <Head title="Clients" />

        <MainTitle> Clients </MainTitle>

        <MainTable :pagination="clients">
            <template #search>
                    <Search :filter="filter" :url="url" />
                </template>

            <template #createButton>
                <SaveClient ref="callOpenModal" :data="clients" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="(tb, index) in clients.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-all ease-linear duration-300 animate-fade-in-down"
                    :key="tb.id + 'tb'" :style="{ animationDelay: `${index * 0.05}s` }">
                    <td class="px-4 py-3">{{ tb.profile_photo_path }}</td>
                    <td class="px-4 py-3">{{ tb.first_name }}</td>
                    <td class="px-4 py-3">{{ tb.last_name }}</td>
                    <td class="px-4 py-3">{{ tb.email }}</td>
                    <td class="px-4 py-3">{{ tb.phone }}</td>
                    <td class="px-4 py-3">{{ tb.country }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.title, tb.icon, tb.description, tb.color)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <DeleteService :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'" />
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>
