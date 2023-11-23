<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SaveAlert from "@/Helpers/Alerts/SaveAlert";
import SimpleForm from "@/Components/Main/Admin/Components/Forms/SimpleForm.vue";
import Ckeditor from "@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue";
import DateRangePicker from "@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/DateRangePicker.vue";

const props = defineProps({
    data: Object,
});

const title = ref("");
const modal = ref(false);
const opration = ref(1);
const experience = ref(null);

const form = useForm({
    title: "",
    description: "",
    start_date: "",
    end_date: "",
    color: "#000000",
});

const save = () => {
    const start_date = document.querySelector("#start");
    const end_date = document.querySelector("#end");

    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            start_date: start_date.value,
            end_date: end_date.value,
        })).post(route("admin.resume.experiences.store"), {
            preserveScroll: true,
            onSuccess: () => {
                ok("Experience created successfully");
            },
            onError: () => {
                console.log("error");
            },
        });
    } else {
        form.transform((data) => ({
            ...data,
            start_date: start_date.value,
            end_date: end_date.value,
        })).put(route("admin.resume.experiences.update", experience.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok("Experience updated successfully");
            },
            onError: () => {
                console.log("error");
            },
        });
    }
};

const openModal = (op, id, titleData, start_date, end_date, description, color) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = "Create a new experience";
    } else {
        title.value = "Edit experience";
        experience.value = id;
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

defineExpose({ openModal });
</script>

<template>
    <div>
        <div class="flex my-3 justify-between gap-3">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">
                Experiences
            </h3>
            <PrimaryButton class="sm:w-auto w-full" @click="openModal(1)">
                <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
                Add experience
            </PrimaryButton>
        </div>

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
                                <DateRangePicker :data="{
                                    start_date: form.start_date,
                                    end_date: form.end_date,
                                }" />

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

                            <!-- <div v-if="opration === 2">
                                <InputLabel for="color" value="Delete this education" />

                                <DangerButton @click="destroy" :class="{ 'opacity-25': form.processing }" class="mt-2" :disabled="form.processing">
                                    Delete
                                </DangerButton>
                            </div> -->

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
