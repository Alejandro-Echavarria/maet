<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import Ckeditor from '@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import DeleteAlert from '@/Helpers/Alerts/DeleteAlert';
import DateRangePicker from '@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/DateRangePicker.vue';

defineOptions({
    layout: MainLayout
});


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
const canDeleteEducation = ref(false);

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

    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            start_date: start_date.value,
            end_date: end_date.value
        })).post(route('admin.resume.educations.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Your education\'s ifnormation was created successfully');
            },
            onError: () => {
                console.log('error');
            }
        });
    } else {
        form.transform((data) => ({
            ...data,
            start_date: start_date.value,
            end_date: end_date.value
        })).put(route('admin.resume.educations.update', education.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Your education\'s ifnormation was updated successfully');
            },
            onError: () => {
                console.log('error');
            }
        });
    }
};

const destroy = () => {
    DeleteAlert().then((result) => {
        if (result.isConfirmed) {
            form.delete(route('admin.resume.educations.destroy', education.value), {
                preserveScroll: true,
                onSuccess: () => {
                    ok('Your education\'s ifnormation was deleted successfully');
                },
                onError: () => {
                    console.log('error');
                },
            });
        }
    });
};

const openModal = (op, id, titleData, start_date, end_date, description, color) => {
    modal.value = true;
    opration.value = op;
    canDeleteEducation.value = op;

    if (op === 1) {
        title.value = 'Add an education';
    } else {
        title.value = 'Edit education';
        education.value = id;
        form.title = titleData;
        form.start_date = start_date;
        form.end_date = end_date;
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
        <div class="flex my-3 justify-between gap-3">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">
                Educations
            </h3>
            <PrimaryButton class="sm:w-auto w-full" @click="openModal(1)">
                <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
                Add education
            </PrimaryButton>
        </div>

        <ol class="relative border-l border-gray-200 dark:border-indigo-700">
            <TransitionGroup name="list" tag="li">
                <li v-for="education in educations" :key="education.id + '-education'" class="mb-10 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-indigo-100 rounded-full mt-1.5 -left-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700">
                    </div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                        {{ education.start_date }} - {{ education.end_date }}
                    </time>
                    <div class="flex gap-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-white">
                            {{ education.title }}
                        </h3>
                        <button class="mr-2">
                            <font-awesome-icon @click="openModal(2, education.id, education.title, education.start_date, education.end_date, education.description, education.color)"
                                class="w-4 h-4 text-gray-400 dark:text-white hover:text-indigo-500  transition duration-300 ease-linear" :icon="['far', 'pen-to-square']" />
                        </button>
                    </div>
                    <p class="mb-4 dark:text-gray-400" v-html="education.description">
                    </p>
                </li>
            </TransitionGroup>
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
                                <DateRangePicker :data="{'start_date': form.start_date, 'end_date': form.end_date}" />

                                <div class="flex gap-2">
                                    <InputError :message="form.errors.start_date" class="mt-2" />
                                    <InputError :message="form.errors.end_date" class="mt-2" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="color" value="Color" />
                                <TextInput v-model="form.color" type="color" class="border-b-0 h-10" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div v-if="opration === 2">
                                <InputLabel for="color" value="Delete this education" />

                                <DangerButton @click="destroy" :class="{ 'opacity-25': form.processing }" class="mt-2" :disabled="form.processing">
                                    Delete
                                </DangerButton>
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
                    Close
                </SecondaryButton>

                <PrimaryButton form="simpleForm" type="submit" @click="save" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Save
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>

<style>
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
  position: absolute;
}
</style>