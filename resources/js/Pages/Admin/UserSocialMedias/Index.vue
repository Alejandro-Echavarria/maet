<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import SaveUserSocialMedia from '@/Pages/Admin/UserSocialMedias/Partials/SaveUserSocialMedia.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    userSocialMedias: Object,
    socialMedias: Object
});

const thead = ref(['social media', 'url', 'created', 'updated']);
</script>

<template>
    <Head title="User social medias" />

    <div>
        <MainTitle>
            User social medias
        </MainTitle>

        <MainTable>
            <template #createButton>
                <SaveUserSocialMedia :socialMedias="socialMedias" />
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
                    <td class="px-4 py-3">{{ tb.social_media_id }}</td>
                    <td class="px-4 py-3">{{ tb.url }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <!-- <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.icon, tb.name)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <TableButton>
                            <font-awesome-icon @click="destroy(tb.id)" class="w-4 h-4 text-red-500"
                                :icon="['far', 'trash-can']" />
                        </TableButton> -->
                    </td>
                </tr>
            </template>
        </MainTable>
    </div>
</template>
