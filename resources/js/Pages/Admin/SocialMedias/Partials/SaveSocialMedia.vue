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
    socialMedias: Object,
    filter: String,
    page: String
});

const iconInput = ref(null);
const nameInput = ref(null);
const title = ref('');
const modal = ref(false);
const socialMedia = ref(null);
const opration = ref(1);

const form = useForm({
    icon: '',
    name: ''
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.socialmedias.store'), {
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
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).put(route('admin.socialmedias.update', socialMedia.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Social media updated successfull');
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