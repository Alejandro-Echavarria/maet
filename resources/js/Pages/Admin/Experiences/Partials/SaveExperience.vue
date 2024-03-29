<script setup>
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import ColorPicker from "@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/ColorsPicker/ColorPicker.vue";
import InputError from "@/Components/InputError.vue";
import SaveAlert from "@/Helpers/Alerts/SaveAlert";
import SimpleForm from "@/Components/Main/Admin/Components/Forms/SimpleForm.vue";
import DateRangePicker from "@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/DateRangePicker.vue";
import Ckeditor from "@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue";
import CKeditorHelper from "@/Helpers/CKeditor/Ckeditor";

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
    color: "gray-100",
});

onMounted(() => {
    CKeditorHelper();
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
        <div class="flex my-3 justify-end">
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
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="sm:col-span-3">
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" ref="titleInput" v-model="form.title" type="text" />

                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
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

                            <div>
                                <InputLabel for="color" value="Color" />

                                <ColorPicker v-model="form.color" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="description" value="Description" class="mb-3" />
                                <Ckeditor id="body" idname="body" key="body" v-model="form.description" :value="form.description"
                                    ref="descriptionInput">
                                    <div id="ckeditorbody"></div>
                                </Ckeditor>

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
