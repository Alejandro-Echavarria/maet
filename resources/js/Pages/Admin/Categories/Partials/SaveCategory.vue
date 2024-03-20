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

const props = defineProps({
    filter: String,
    page: String
});

const nameInput = ref(null);
const title = ref('');
const modal = ref(false);
const category = ref(null);
const opration = ref(1);

const form = useForm({
    name: '',
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.categories.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Category created successfully');
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
        })).put(route('admin.categories.update', category.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Category updated successfully');
            },
            onError: () => {
                if (form.errors.url) {
                    urlInput.value.focus();
                }
            }
        });
    }
};

const openModal = (op, slug, name) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new category';
    } else {
        title.value = 'Edit category';
        category.value = slug;
        form.name = name;
    }

    setTimeout(() => nameInput.value.focus(), 250);
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
            Add category
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
                                <InputLabel for="name" value="Name" />
                                <TextInput v-model="form.name" id="name" ref="nameInput" type="text" />

                                <InputError :message="form.errors.name" class="mt-2" />
                                <InputError :message="form.errors.slug" class="mt-2" />
                            </div>
                        </div>
                    </template>
                </SimpleForm>
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