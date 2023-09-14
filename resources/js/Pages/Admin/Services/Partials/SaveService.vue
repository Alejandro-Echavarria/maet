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

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

const title = ref('');
const modal = ref(false);
const opration = ref(1);

const form = useForm({
    title: '',
    icon: '',
    description: '',
    color: ''
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data
        })).post(route('admin.services.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Service created successfully');
            },
            onError: () => {
                if (form.errors.url) {
                    urlInput.value.focus();
                }
            }
        });
    } else {
        form.transform((data) => ({
            ...data
        })).put(route('admin.usersocialmedias.update', userSocialMedia.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('User social media updated successfully');
            },
            onError: () => {
                if (form.errors.url) {
                    urlInput.value.focus();
                }
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
        form.id = id;
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

        
        <DialogModal :show="modal" :maxWidth="'2xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" ref="titleInput" v-model="form.title" type="text" />

                    <InputError :message="form.errors.title" class="mt-2" />
                </div>

                <div class="mt-4">
                    <InputLabel for="icon" value="icon" />
                    <TextInput id="icon" ref="iconInput" v-model="form.icon" type="text" />

                    <InputError :message="form.errors.icon" class="mt-2" />
                </div>

                <div class="mt-4">
                    <InputLabel for="description" value="description" />
                    <TextInput id="description" ref="descriptionInput" v-model="form.description" type="text" />

                    <InputError :message="form.errors.icon" class="mt-2" />
                </div>

                <div class="mt-4">
                    <InputLabel for="color" value="color" />
                    <TextInput id="color" ref="colorInput" v-model="form.color" type="text" />

                    <InputError :message="form.errors.color" class="mt-2" />
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