<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SavePlatform from '@/Pages/Admin/Platforms/Partials/SavePlatform.vue';
import DeletePlatform from '@/Pages/Admin/Platforms/Partials/DeletePlatform.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    platforms: Object,
    platformTypes: Object,
    filter: String,
    page: String
});

const thead = ['platform', 'url', 'For', 'created', 'updated'];
const url = 'admin.platforms.index';

const callOpenModal = ref(null);

const openModal = (op, id, socialMediaId, url) => {
    callOpenModal.value.openModal(op, id, socialMediaId, url);
};
</script>

<template>
    <Head title="Platforms" />

    <div>
        <MainTitle>
            Platforms
        </MainTitle>

        <MainTable :pagination="platforms">
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>

            <template #createButton>
                <SavePlatform ref="callOpenModal" :platformTypes="platformTypes" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in platforms.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td id="tech-container" class="px-4 py-3 flex"><span v-html="tb.platform_type.icon"></span>&nbsp-&nbsp{{ tb.platform_type.name }}</td>
                    <td class="px-4 py-3">{{ tb.url }}</td>
                    <td class="px-4 py-3">{{ tb.platformable_type }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.platform_type_id, tb.url)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <DeletePlatform :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'"/>
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>
