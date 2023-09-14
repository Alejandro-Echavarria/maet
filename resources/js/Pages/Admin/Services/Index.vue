<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SaveService from '@/Pages/Admin/Services/Partials/SaveService.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    services: Object
});

const thead = ['title', 'icon', 'description', 'color', 'created', 'updated'];

const callOpenModal = ref(null);

const openModal = (id, title, icon, description, color) => {
    callOpenModal.value.openModal(id, title, icon, description, color);
};
</script>

<template>
    <Head title="Services" />

    <div>
        <MainTitle>
            Services
        </MainTitle>

        <MainTable>
            <template #createButton>
                <SaveService ref="callOpenModal" :data="services" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in services.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td class="px-4 py-3">{{ tb.title }}</td>
                    <td class="px-4 py-3">{{ tb.icon }}</td>
                    <td class="px-4 py-3">{{ tb.description }}</td>
                    <td class="px-4 py-3">{{ tb.color }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.title, tb.icon, tb.description, tb.color)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <!-- <DeleteUserSocialMedia :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'"/> -->
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>