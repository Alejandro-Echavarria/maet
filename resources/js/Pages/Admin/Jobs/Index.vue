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
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from '@/Components/Main/Admin/Components/Paginations/Pagination.vue';
import Avatar from '@/Components/Main/Admin/Components/Images/Avatar.vue';

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

const openModal = (op, id, category_id, client_id, titleData, slug, logo_url, color, file, project_name, link, technologies, preview, body, price, alt_banner_image, status) => {
    callOpenModal.value.openModal(op, id, category_id, client_id, titleData, slug, logo_url, color, file, project_name, link, technologies, preview, body, price, alt_banner_image, status);
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
                <SaveJob ref="callOpenModal" :data="{ categories, clients, technologies }" :filter="filter"
                    :page="page" />
            </template>
        </CreateContainer>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-8">
            <SectionJobs v-for="(job, index) in jobs.data" :key="'card-' + job.id"
                :class="['animate-fade-in-down', { 'md:col-span-2': index === 0 }]"
                :style="{ animationDelay: `${index * 0.1}s` }">
                <template #image>
                    <img class="rounded-t-xl h-64 w-full overflow-auto object-cover"
                        :src="`/storage/${job?.images[0]?.url}`" alt="" />
                </template>

                <template #deleteButton>
                    <DeleteJob :id="job.slug" :filter="filter" :page="page" :key="'delete-' + job.id" />
                </template>

                <template #title>
                    {{ job.title }}
                </template>

                <template #preview>
                    <div id="content-ckeditor">
                        <span v-html="truncateData(job.preview, index)" />
                    </div>

                    <div class="flex items-center space-x-2">
                        <Avatar :name="job.client.first_name + ' ' + job.client.last_name" :image="job.client.url" />
                        <div class="text-sm text-gray-600">
                            <span>{{ job.client.first_name + ' ' + job.client.last_name }}</span>
                        </div>
                    </div>
                </template>
                <template #actions>
                    <div class="flex my-3 justify-end">
                        <SecondaryButton class="sm:w-auto w-full" :hidden="false"
                            @click="openModal(2, job.id, job.category_id, job.client_id, job.title, job.slug, job.logo_url, job.color, job?.images[0]?.url, job.project_name, job.link, job.technologies, job.preview, job.body, job.price, job.alt_banner_image, job.status)">
                            <font-awesome-icon class="mr-2" :icon="['far', 'pen-to-square']" />
                            edit job
                        </SecondaryButton>
                    </div>
                </template>
            </SectionJobs>
            <!-- <TransitionGroup name="card" appear>
            </TransitionGroup> -->
        </div>

        <Pagination :pagination="jobs" />
    </div>
</template>

<style scoped>
.card-move,
.card-enter-active,
.card-leave-active {
    transition: 0.35s ease;
}

.card-enter-from,
.card-leave-to {
    opacity: 0;
    transform: translateY(10px);
}
</style>