<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import SaveSocialMedia from '@/Pages/Admin/SocialMedias/Partials/SaveSocialMedia.vue';
import DeleteSocialMedia from '@/Pages/Admin/SocialMedias/Partials/DeleteSocialMedia.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    socialMedias: Object,
    filter: String,
    page: String
});

const thead = ['icon', 'name', 'created', 'updated'];
const url = 'admin.socialmedias.index';


const callOpenModal = ref(null);

const openModal = (op, id, socialMediaId, url) => {
    callOpenModal.value.openModal(op, id, socialMediaId, url);
};
</script>

<template>
    <Head title="Social medias" />

    <div>
        <MainTitle>
            Social medias
        </MainTitle>

        <MainTable :pagination="socialMedias">
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>
            <template #createButton>
                <SaveSocialMedia ref="callOpenModal" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in socialMedias.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td class="px-4 py-3">{{ tb.icon }}</td>
                    <td class="px-4 py-3">{{ tb.name }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.icon, tb.name)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <DeleteSocialMedia :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'" />
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>
