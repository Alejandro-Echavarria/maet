<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SaveCategory from '@/Pages/Admin/Categories/Partials/SaveCategory.vue';
import DeleteCategory from '@/Pages/Admin/Categories/Partials/DeleteCategory.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    filter: String,
    page: String
});

const thead = ['slug', 'name', 'created', 'updated'];
const url = 'admin.categories.index';

const callOpenModal = ref(null);

const openModal = (op, slug, name) => {
    callOpenModal.value.openModal(op, slug, name);
};
</script>

<template>

    <Head title="Categories" />

    <div>
        <MainTitle> Categories </MainTitle>

        <MainTable :pagination="categories">
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>

            <template #createButton>
                <SaveCategory ref="callOpenModal" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in categories.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td class="px-4 py-3">{{ tb.slug }}</td>
                    <td class="px-4 py-3">{{ tb.name }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.slug, tb.name)" class="w-4 h-4 text-indigo-500"
                                :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <DeleteCategory :id="tb.slug" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'" />
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>