<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SaveUserSocialMedia from '@/Pages/Admin/UserSocialMedias/Partials/SaveUserSocialMedia.vue';
import DeleteUserSocialMedia from '@/Pages/Admin/UserSocialMedias/Partials/DeleteUserSocialMedia.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    userSocialMedias: Object,
    socialMedias: Object,
    filter: String,
    page: String
});

const thead = ['social media', 'url', 'created', 'updated'];
const url = 'admin.usersocialmedias.index';

const callOpenModal = ref(null);

const openModal = (op, id, socialMediaId, url) => {
    callOpenModal.value.openModal(op, id, socialMediaId, url);
};
</script>

<template>
    <Head title="User social medias" />

    <div>
        <MainTitle>
            User social medias
        </MainTitle>

        <MainTable :pagination="userSocialMedias">
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>

            <template #createButton>
                <SaveUserSocialMedia ref="callOpenModal" :socialMedias="socialMedias" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in userSocialMedias.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td class="px-4 py-3">{{ tb.social_media.name }}</td>
                    <td class="px-4 py-3">{{ tb.url }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.social_media_id, tb.url)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <DeleteUserSocialMedia :id="tb.id" :filter="filter" :page="page" :key="tb.id + 'deleteBtn'"/>
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>
