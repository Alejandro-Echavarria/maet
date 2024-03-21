<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import IconTextInput from "@/Components/Main/Admin/Components/Forms/Inputs/TextInput/IconTextInput.vue";
import ToggleSwitch from "@/Components/Main/Admin/Components/Forms/Inputs/ToggleSwitch/ToggleSwitch.vue";
import ColorPicker from "@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/ColorsPicker/ColorPicker.vue";
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';

const props = defineProps({
    filter: String,
    page: String
});

const nameInput = ref(null);
const title = ref('');
const modal = ref(false);
const technology = ref(null);
const opration = ref(1);

const form = useForm({
    name: '',
    slug: '',
    icon: '',
    color: 'gray-100',
    main: false
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route('admin.technologies.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Technology created successfully');
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
        })).put(route('admin.technologies.update', technology.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Technology updated successfully');
            },
            onError: () => {
                if (form.errors.url) {
                    urlInput.value.focus();
                }
            }
        });
    }
};

const openModal = (op, slug, name, icon, main, color) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new technology';
    } else {
        title.value = 'Edit technologies';
        technology.value = slug;
        form.name = name;
        form.icon = icon;
        form.main = main;
        form.color = color
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
            Add technology
        </PrimaryButton>

        <DialogModal :show="modal" :maxWidth="'3xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                            <div class="sm:col-span-3">
                                <InputLabel for="name" value="Name" />
                                <TextInput v-model="form.name" id="name" ref="nameInput" type="text" />

                                <InputError :message="form.errors.name" class="mt-2" />
                                <InputError :message="form.errors.slug" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="color" value="Color" />
                                <ColorPicker v-model="form.color" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div class="flex items-center sm:col-span-4 gap-6">
                                <div class="grow">
                                    <InputLabel for="icon" value="Icon" />
                                    <IconTextInput id="icon" ref="iconInput" v-model="form.icon" />
    
                                    <InputError :message="form.errors.icon" class="mt-2" />
                                </div>

                                <div>
                                    <InputLabel for="main" value="Main" />
                                    <ToggleSwitch id="main" ref="mainInput" v-model="form.main" class="mt-2" />
    
                                    <InputError :message="form.errors.main" class="mt-2" />
                                </div>
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