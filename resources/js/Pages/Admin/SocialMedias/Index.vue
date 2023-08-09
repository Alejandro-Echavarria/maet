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

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    socialMedias: Object
});

const form = useForm({
    icon: '',
    name: ''
});

const iconInput = ref(null);
const nameInput = ref(null);
const thead = ref(['icon', 'name', 'created', 'updated']);
const tbody = ref(props.socialMedias);

const socialMedia = ref('');
const title = ref('');
const modal = ref(false);
const opration = ref(1);

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
    form.reset();
};

const save = () => {
    if (opration.value === 1) {
        form.post(route('admin.socialmedias.store'), {
            preserveScroll: true,
            onSuccess: () => {
                tbody.value = props.socialMedias;
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
                tbody.value = props.socialMedias;
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

const destroy = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        focusCancel: true,
        customClass: {
            confirmButton: 'ml-2 inline-flex items-center place-content-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
            cancelButton: 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150'
        },
        buttonsStyling: false,
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('admin.socialmedias.destroy', id), {
                onSuccess: () => {
                    ok('Social media deleted successfully');
                },
                onError: () => {
                    console.log('error');
                },
                onFinish: () => {
                    tbody.value = props.socialMedias;
                }
            });
        }
    });
};

const ok = (msj, type = 'success', timer = 10000) => {
    form.reset();
    closeModal();

    Swal.fire({
        icon: type,
        title: msj,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
}
</script>

<template>
    <Head title="Social medias" />

    <div>
        <MainTitle>
            Social medias
        </MainTitle>

        <MainTable>
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
                <tr v-for="tb in tbody"
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
                        <TableButton>
                            <font-awesome-icon @click="destroy(tb.id)" class="w-4 h-4 text-red-500"
                                :icon="['far', 'trash-can']" />
                        </TableButton>
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

<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>