<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import Ckeditor from '@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import DateRangePicker from '@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/DateRangePicker.vue';

const props = defineProps({
    educations: {
        type: Object,
        required: true
    }
});

const title = ref('');
const modal = ref(false);
const opration = ref(1);
const education = ref(null);

const form = useForm({
    title: '',
    description: '',
    start_date: '',
    end_date: '',
    color: '#000000'
});

const save = () => {
    const start_date = document.querySelector('#start');
    const end_date = document.querySelector('#end');

    form.transform((data) => ({
        ...data,
        start_date: start_date.value,
        end_date: end_date.value
    })).post(route('admin.resume.education.store'), {
        preserveScroll: true,
        onSuccess: () => {
            ok('Your education\'s ifnormation was updated successfully');
        },
        onError: () => {

        }
    });
};

const openModal = (op, id, titleData, icon, description, color) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Add an education';
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
</script>

<template>
    <div>
        <div class="flex my-3 justify-between">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Educations</h3>
            <PrimaryButton @click="openModal(1)">
                Add education
            </PrimaryButton>
        </div>

        <ol class="relative border-l border-gray-200 dark:border-indigo-700">
            <li v-for="education in educations" :key="education.id + '-education'" class="mb-10 ml-4">
                <div
                    class="absolute w-3 h-3 bg-indigo-100 rounded-full mt-1.5 -left-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700">
                </div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                    {{ education.start_date }} - {{ education.end_date }}
                </time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ education.title }}
                </h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400" v-html="education.description">
                </p>
            </li>
        </ol>

        <DialogModal :show="modal" :maxWidth="'6xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" ref="titleInput" v-model="form.title" type="text" />

                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="dates" value="Dates" />
                                <DateRangePicker :value="form.start_date" />

                                <div class="flex gap-2">
                                    <InputError :message="form.errors.start_date" class="mt-2" />
                                    <InputError :message="form.errors.end_date" class="mt-2" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="color" value="Color" />
                                <TextInput v-model="form.color" type="color" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div class="grid-cols-1 sm:col-span-3">
                                <!-- <InputLabel for="description" value="Description" class="mb-3" /> -->
                                <Ckeditor v-model="form.description" :value="form.description" id="description"
                                    ref="descriptionInput" />

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

        <pre>
            {{ form.dates }}
        </pre>
    </div>
</template>