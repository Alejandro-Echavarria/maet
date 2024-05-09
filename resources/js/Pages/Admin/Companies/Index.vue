<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SaveCompany from '@/Pages/Admin/Companies/Partials/SaveCompany.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    companies: Object,
    companyTypes: Object,
});

const thead = ['company type', 'name', 'tax id', 'email', 'phone'];
const url = 'admin.companies.index';

const callOpenModal = ref(null);

const openModal = (op, data) => {
    callOpenModal.value.openModal(op, data);
};
</script>

<template>

    <Head title="Companies" />

    <div>
        <MainTitle>
            Companies
        </MainTitle>

        <MainTable :pagination="companies">
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>

            <template #createButton>
                <SaveCompany ref="callOpenModal" :data="{ companyTypes }" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in companies.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td class="px-4 py-3">{{ tb.company_type.name }}</td>
                    <td class="px-4 py-3">{{ tb.name }}</td>
                    <td class="px-4 py-3">{{ tb.tax_id_number }}</td>
                    <td class="px-4 py-3">{{ tb.email }}</td>
                    <td class="px-4 py-3">{{ tb.phone }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb)" class="w-4 h-4 text-indigo-500"
                                :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <!-- <DeleteCategory :id="tb.slug" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'" /> -->
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>