<script setup>
import { ref } from 'vue';
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
import SimpleTextArea from '@/Components/Main/Admin/Components/Forms/Inputs/TextArea/SimpleTextArea.vue';
import VueSelect from "@/Components/Main/Admin/Components/Selects/VueSelect.vue";
import ToggleSwitch from "@/Components/Main/Admin/Components/Forms/Inputs/ToggleSwitch/ToggleSwitch.vue";

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

const title = ref('');
const modal = ref(false);
const opration = ref(1);
const client = ref(null);
const clientTypesOptions = ref(props.data.clientTypes);

const form = useForm({
    client_type_id: null,
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    country: '',
    description: '',
    status: false,
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
            preserveState: true,
            onSuccess: () => {
                ok('Client created successfully');
            },
            onError: () => {
                console.log("error");
            }
        });
    } else {
        form.transform((data) => ({
            ...data,
            _method: 'put',
            search: props.filter,
            page: props.page
        })).post(route('admin.clients.update', client.value), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                ok('Client updated successfully');
            },
            onError: () => {
                console.log("error");
            }
        });
    }
};

const openModal = (op, id, client_type_id, first_name, last_name, email, phone, country, description, status, file) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new client';
    } else {
        title.value = 'Edit client';
        client.value = id;
        form.client_type_id = client_type_id;
        form.first_name = first_name;
        form.last_name = last_name;
        form.email = email;
        form.phone = phone;
        form.country = country;
        form.description = description;
        form.status = status;
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
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                            <div class="md:col-span-2 row-span-6">
                                <Images v-model="form.file" :file="form.file" access="admin" />

                                <InputError :message="form.errors.file" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="first_name" value="First name" />
                                <TextInput id="first_name" ref="firstNameInput" v-model="form.first_name" type="text" />

                                <InputError :message="form.errors.first_name" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="last_name" value="Last name" />
                                <TextInput id="last_name" ref="lastNameInput" v-model="form.last_name" type="text" />

                                <InputError :message="form.errors.last_name" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="client_type_id" value="Client type" />
                                <VueSelect id="client_type_id" label="name" v-model="form.client_type_id" :append="true"
                                    :options="clientTypesOptions" :reduce="clientTypesOptions => clientTypesOptions.id"
                                    :select-on-tab="true" />

                                <InputError :message="form.errors.client_type_id" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" ref="emailInput" v-model="form.email" type="email" />

                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="phone" value="Phone" />
                                <TextInput id="phone" ref="phoneInput" v-model="form.phone" type="text" />

                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>

                            <div class="flex items-center md:col-span-2 gap-6">
                                <div class="grow">
                                    <InputLabel for="country" value="Country" />
                                    <TextInput id="country" ref="countryInput" v-model="form.country" type="text" />
    
                                    <InputError :message="form.errors.country" class="mt-2" />
                                </div>

                                <div>
                                    <InputLabel for="status" value="Status" />
                                    <ToggleSwitch id="status" ref="statusInput" v-model="form.status" class="mt-2" />

                                    <InputError :message="form.errors.status" class="mt-2" />
                                </div>
                            </div>

                            <div class="md:col-span-4">
                                <InputLabel for="description" value="Description" />
                                <SimpleTextArea id="description" ref="descriptionInput" v-model="form.description" />

                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>
                        </div>
                    </template>
                </SimpleForm>

                <div class="md:col-span-4">
                    <div class="flex justify-center w-full">
                        <p class="text-lg font-medium">Jobs (projects)</p>
                            <pre>{{ data }}</pre>
<!-- <pre>{{data.clients.data}}</pre>
                        <div v-for="job in data.clients">
                            <pre>{{ data }}</pre>
                        </div> -->
                    </div>
                </div>
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