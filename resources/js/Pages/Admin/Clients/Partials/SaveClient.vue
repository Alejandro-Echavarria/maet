<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Images from "@/Components/Main/Admin/Components/Forms/Inputs/Images/Images.vue";
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

const title = ref('');
const modal = ref(false);
const opration = ref(1);
const client = ref(null);

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    country: '',
    description: '',
    file: null,
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.clients.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Client created successfully');
            },
            onError: () => {

            }
        });
    } else {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).put(route('admin.clients.update', service.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Client updated successfully');
            },
            onError: () => {

            }
        });
    }
};

const openModal = (op, id, first_name, last_name, email, phone, country, description, file) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new client';
    } else {
        title.value = 'Edit client';
        client.value = id;
        form.first_name = first_name;
        form.last_name = last_name;
        form.email = email;
        form.phone = phone;
        form.country = country;
        form.description = description;
        form.file = file;
    }
};

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
};

const ok = (msj, type, timer) => {
    closeModal();
    SaveAlert(msj, type, timer);
};

defineExpose({ openModal });
</script>

<template>
    <div>
        <PrimaryButton class="w-full" @click="openModal(1)">
            <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
            Add client
        </PrimaryButton>

        <DialogModal :show="modal" :maxWidth="'6xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                            <div class="sm:col-span-2">
                                <Images v-model="form.file" :file="form.file" typeImage="clients" />

                                <InputError :message="form.errors.file" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="first_name" value="First name" />
                                <TextInput id="first_name" ref="firstNameInput" v-model="form.first_name" type="text" />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="last_name" value="Last name" />
                                <TextInput id="last_name" ref="lastNameInput" v-model="form.last_name" type="text" />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>
                        </div>
                    </template>
                </SimpleForm>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal" class="mr-3">
                    Cancel
                </SecondaryButton>

                <PrimaryButton form="simpleForm" type="submit" @click="save" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Save
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>