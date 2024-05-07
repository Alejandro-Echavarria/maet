<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import VueSelect from '@/Components/Main/Admin/Components/Selects/VueSelect.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';

const props = defineProps({
    platformTypes: Object,
    filter: String,
    page: String
});

const urlInput = ref(null);
const title = ref('');
const modal = ref(false);
const platform = ref(null);
const opration = ref(1);
const options = ref(props.platformTypes);

const form = useForm({
    platform_type_id: '',
    url: '',
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.platforms.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Platform created');
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
        })).put(route('admin.platforms.update', platform.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Platform updated');
            },
            onError: () => {
                if (form.errors.url) {
                    urlInput.value.focus();
                }
            }
        });
    }
};

const openModal = (op, id, platform_type_id, url) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new platform';
    } else {
        title.value = 'Edit platform';
        platform.value = id;
        form.platform_type_id = platform_type_id;
        form.url = url;
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
            Add a platform
        </PrimaryButton>

        <DialogModal :show="modal" :maxWidth="'2xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <InputLabel for="platform" value="Platform" />
                                <VueSelect id="platform_type_id" label="name" v-model="form.platform_type_id" :append="true"
                                    :options="options" :reduce="options => options.id" :select-on-tab="true" />
                                <InputError :message="form.errors.platform_type_id" class="mt-2" />
                            </div>
            
                            <div>
                                <InputLabel for="url" value="URL" />
                                <TextInput id="url" ref="urlInput" v-model="form.url" type="url" placeholder="https://example.com" />
            
                                <InputError :message="form.errors.url" class="mt-2" />
                            </div>
                        </div>
                    </template>
                </SimpleForm>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal" class="mr-3">
                    Cancel
                </SecondaryButton>

                <PrimaryButton form="simpleForm" @click="save" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>
