<script setup>
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Components/Main/Admin/Layout/MainLayout.vue";
import MainTitle from "@/Components/Main/Admin/Components/Titles/MainTitle.vue";
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SaveClient from '@/Pages/Admin/Clients/Partials/SaveClient.vue';
import DeleteClient from '@/Pages/Admin/Clients/Partials/DeleteClient.vue';
import Avatar from '@/Components/Main/Admin/Components/Images/Avatar.vue';

defineOptions({
    layout: MainLayout,
});

const props = defineProps({
    clients: {
        type: Object,
        required: true,
    },
    clientTypes: {
        type: Object,
    },
    filter: String,
    page: String
});

const thead = ['photo', 'First name', 'last name', 'client type', 'phone', 'satatus'];
const url = 'admin.clients.index';
const callOpenModal = ref(null);

const openModal = (op, id, client_type_id, first_name, last_name, email, phone, country, description, status, file) => {
    callOpenModal.value.openModal(op, id, client_type_id, first_name, last_name, email, phone, country, description, status, file);
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
                <SaveClient ref="callOpenModal" :data="{ clients, clientTypes }" :filter="filter" :page="page" />
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
                    <td class="px-4 py-3">
                        <Avatar :name="tb.first_name + ' ' + tb.last_name" :image="tb.images[0]?.url" />
                    </td>
                    <td class="px-4 py-3">
                        <div class="text-gray-800 font-medium">
                            {{ tb.first_name }}
                        </div>
                        <div>
                            {{ tb.email }}
                        </div>
                    </td>
                    <td class="px-4 py-3">{{ tb.last_name }}</td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold rounded-full" :class="`bg-${tb.client_type.color}/20 text-${tb.client_type.color}`">
                            {{ tb.client_type.name }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ tb.phone }}</td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold rounded-full" :class="tb.status ? 'bg-green-500/20 text-green-500' : 'bg-red-500/20 text-red-500'">
                            <template v-if="tb.status">
                                Activo
                            </template>

                            <template v-else>
                                Inactivo
                            </template>
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end">
                            <TableButton>
                                <font-awesome-icon @click="openModal(2, tb.id, tb.client_type_id, tb.first_name, tb.last_name, tb.email, tb.phone, tb.country, tb.description, tb.status, tb?.images[0]?.url)"
                                    class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                            </TableButton>
                            <DeleteClient :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'" />
                        </div>
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>
