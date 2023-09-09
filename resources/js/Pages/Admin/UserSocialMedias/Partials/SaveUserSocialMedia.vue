<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Swal from 'sweetalert2';
import VueSelect from '@/Components/Main/Admin/Components/Selects/VueSelect.vue';

const props = defineProps({
    socialMedias: Object,
    filter: String,
    page: String
});

const urlInput = ref(null);
const title = ref('');
const modal = ref(false);
const userSocialMedia = ref(null);
const opration = ref(1);
const options = ref(props.socialMedias);

const form = useForm({
    social_media_id: '',
    url: '',
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.usersocialmedias.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('User social media created successfully');
            },
            onError: () => {
                if (form.errors.url) {
                    urlInput.value.focus();
                }
            }
        });
    } else {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
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

const openModal = (op, id, social_media_id, url) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new social media';
    } else {
        title.value = 'Edit social media';
        userSocialMedia.value = id;
        form.social_media_id = social_media_id;
        form.url = url;
    }
};

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
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
                    <InputLabel for="social-media" value="Social media" />
                    <VueSelect
                        id="social_media_id"
                        label="name"
                        v-model="form.social_media_id"
                        :append="true"
                        :options="options"
                        :reduce="options => options.id"
                        :select-on-tab="true" />
                    <InputError :message="form.errors.social_media_id" class="mt-2" />
                </div>

                <div class="mt-4">
                    <InputLabel for="url" value="URL" />
                    <TextInput id="url" ref="urlInput" v-model="form.url" type="url" placeholder="https://example.com" />

                    <InputError :message="form.errors.url" class="mt-2" />
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
