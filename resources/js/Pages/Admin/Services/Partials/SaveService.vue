<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import Ckeditor from '@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue';

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

const title = ref('');
const modal = ref(false);
const opration = ref(1);
const service = ref(null);

const form = useForm({
    title: '',
    icon: '',
    description: '',
    color: ''
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.services.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Service created successfully');
            },
            onError: () => {

            }
        });
    } else {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).put(route('admin.services.update', service.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Service updated successfully');
            },
            onError: () => {

            }
        });
    }
};

const openModal = (op, id, titleData, icon, description, color) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new service';
    } else {
        title.value = 'Edit service';
        service.value = id;
        form.title = titleData;
        form.icon = icon;
        form.description = description;
        form.color = color;
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
            Add social media
        </PrimaryButton>

        <DialogModal :show="modal" :maxWidth="'6xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" ref="titleInput" v-model="form.title" type="text" />

                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="icon" value="Icon" />
                                <TextInput id="icon" ref="iconInput" v-model="form.icon" type="text" />

                                <InputError :message="form.errors.icon" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="color" value="Color" />
                                <TextInput id="color" ref="colorInput" v-model="form.color" type="text" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="description" value="Description" class="mb-3" />
                                <Ckeditor v-model="form.description" :value="form.description" id="description" ref="descriptionInput" />

                                <InputError :message="form.errors.description" class="mt-2" />
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