<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import SaveJob from '@/Pages/Admin/Jobs/Partials/SaveJob.vue';
import DeleteJob from '@/Pages/Admin/Jobs/Partials/DeleteJob.vue';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import CreateContainer from '@/Components/Main/Containers/CreateContainer.vue';
import SectionJobs from '@/Components/Main/Containers/Sections/SectionJobs.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Main/Admin/Components/Paginations/Pagination.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    jobs: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    clients: {
        type: Object,
    },
    technologies: {
        type: Object
    },
    filter: String,
    page: String
});

const url = 'admin.jobs.index';

const truncateData = (data, index) => {
    if (data.length > 90 && index !== 0) {
        return data.substring(0, 90) + '...';
    } else {
        if (data.length > 180 && index === 0) {
            return data.substring(0, 180) + '...';
        } else {
            return data;
        }
    }
}

const callOpenModal = ref(null);

const openModal = (op, id, titleData, start_date, end_date, description, color, project_name, technologies, preview, body) => {
    callOpenModal.value.openModal(op, id, titleData, start_date, end_date, description, color, project_name, technologies, preview, body);
};
</script>

<template>
    <div>
        <Head title="Jobs" />

        <MainTitle>
            Jobs
        </MainTitle>

        <CreateContainer>
            <template #search>
                <Search :filter="filter" :url="url" />
            </template>

            <template #createButton>
                <SaveJob ref="callOpenModal" :data="{ categories, clients, technologies }" :filter="filter" :page="page" />
            </template>
        </CreateContainer>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-8">
            <TransitionGroup name="card">
                <SectionJobs v-for="(job, index) in jobs.data" :key="'card-' + job.id"
                    :class="{ 'md:col-span-2': index === 0 }">
                    <template #deleteButton>
                        <DeleteJob :id="job.id" :filter="filter" :page="page" :key="'delete-' + job.id" />
                    </template>
                    <template #title>
                        {{ job.title }}
                    </template>
                    <template #preview>
                        <span v-html="truncateData(job.preview, index)" />
                    </template>
                    <template #actions>
                        <div class="flex my-3 justify-end">
                            <PrimaryButton class="sm:w-auto w-full"
                                @click="openModal(2, job.id, job.category_id, job.client_id, job.title, job.logo_url, job.color, job.project_name, job.technologies, job.preview, job.body)">
                                <font-awesome-icon class="mr-2" :icon="['far', 'pen-to-square']" />
                                edit job
                            </PrimaryButton>
                        </div>
                    </template>
                </SectionJobs>
            </TransitionGroup>
        </div>

        <Pagination :pagination="jobs" />
    </div>
</template>

<style scoped>
.card-move,
.card-enter-active,
.card-leave-active {
    transition: 0.3s ease;
}

.card-enter-from,
.card-leave-to {
    opacity: 0;
    transform: translateY(10px);
}
</style>