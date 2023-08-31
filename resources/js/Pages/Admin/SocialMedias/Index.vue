<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Swal from 'sweetalert2';
import Search from '@/Components/Main/Admin/Components/Searchs/Search.vue';
import DeleteSocialMedia from '@/Pages/Admin/SocialMedias/Partials/DeleteSocialMedia.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    socialMedias: Object,
    filter: String
});

const iconInput = ref(null);
const nameInput = ref(null);
const thead = ref(['icon', 'name', 'created', 'updated']);
const socialMedia = ref('');
const opration = ref(1);
const title = ref('');
const modal = ref(false);
const url = 'admin.socialmedias.index';

const search = ref(props?.filter);
const page = ref(props.socialMedias?.current_page);

const form = useForm({
    icon: '',
    name: '',
    search: search.value,
    page: page.value
});

const save = () => {
    if (opration.value === 1) {
        form.post(route('admin.socialmedias.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Social media created successfully');
            },
            onError: () => {
                if (form.errors.name) {
                    nameInput.value.focus();
                }

                if (form.errors.icon) {
                    iconInput.value.focus();
                }
            }
        });
    } else {
        form.put(route('admin.socialmedias.update', socialMedia.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Social media updated successfully');
            },
            onError: () => {
                if (form.errors.name) {
                    nameInput.value.focus();
                }

                if (form.errors.icon) {
                    iconInput.value.focus();
                }
            }
        });
    }
};

const openModal = (op, id, icon, name) => {
    modal.value = true;
    opration.value = op;

    if (op == 1) {
        title.value = 'Create a new social media';
    } else {
        title.value = 'Edit social media';
        socialMedia.value = id;
        form.icon = icon;
        form.name = name;
    }

    setTimeout(() => iconInput.value.focus(), 250);
};

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset('icon', 'name');
};

const ok = (msj, type = 'success', timer = 10000) => {
    closeModal();

    Swal.fire({
        icon: type,
        title: msj,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        padding: '0.4em',
        showCloseButton: true,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
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
                <Search :filter="filter" :url="url" @updateSearch="(newValue) => form.search = newValue" :key="'socialMedia-search'+1" />
            </template>
            <template #createButton>
                <PrimaryButton @click="openModal(1)">
                    <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
                    Add social media
                </PrimaryButton>
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
                        <DeleteSocialMedia :id="tb.id + 'deleteBtn'" :search="form.search" :page="form.page" :key="tb.id + 'deleteBtn'"/>
                    </td>
                </tr>
            </template>
        </MainTable>

        <DialogModal :show="modal" :maxWidth="'2xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <InputLabel for="icon" value="Icon" />
                    <TextInput v-model="form.icon" id="icon" ref="iconInput" type="text" placeholder="fas-user" />

                    <InputError :message="form.errors.icon" class="mt-2" />
                </div>

                <div class="mt-4">
                    <InputLabel for="name" value="Name" />
                    <TextInput v-model="form.name" id="name" ref="nameInput" type="text" />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal" class="mr-3">
                    Cancel
                </SecondaryButton>

                <PrimaryButton @click="save" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>
