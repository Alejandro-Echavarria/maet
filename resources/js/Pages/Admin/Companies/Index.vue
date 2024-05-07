<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';


defineOptions({
    layout: MainLayout
});

const props = defineProps({
    companies: Object
});

const thead = ['company type', 'name', 'tax id', 'email', 'phone'];
const url = 'admin.companies.index';

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
                <SavePlatform ref="callOpenModal" :platformTypes="platformTypes" :filter="filter" :page="page" />
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>
        </MainTable>
    </div>
</template>