<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SaveAlert from "@/Helpers/Alerts/SaveAlert";
import SimpleForm from "@/Components/Main/Admin/Components/Forms/SimpleForm.vue";
import Ckeditor from "@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue";
import ColorPicker from "@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/ColorsPicker/ColorPicker.vue";
import VueSelect from "@/Components/Main/Admin/Components/Selects/VueSelect.vue";
import Images from "@/Components/Main/Admin/Components/Forms/Inputs/Images/Images.vue";

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

const title = ref("");
const modal = ref(false);
const opration = ref(1);
const job = ref(null);
const categoriesOptions = ref(props.data.categories);
const clientOptions = ref(props.data.clients);
const technologyOptions = ref(props.data.technologies);
const urlCkeditorStoreImage = 'admin.ckeditor.images.job.store';

const form = useForm({
    category_id: "",
    client_id: "",
    title: "",
    logo_url: "",
    color: "gray-100",
    file: null,
    project_name: "",
    technologies: [],
    preview: "",
    body: "",
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route("admin.jobs.store"), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                ok("Job created successfully");
            },
            onError: () => {
                console.log("error");
            },
        });
    } else {
        form.transform((data) => ({
            ...data,
            _method: 'put',
            search: props.filter,
            page: props.page,
        })).post(route("admin.jobs.update", job.value), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                ok("Job updated successfully");
            },
            onError: () => {
                console.log("error");
            },
        });
    }
};

const openModal = (op, id, category_id, client_id, titleData, logo_url, color, file, project_name, technologies, preview, body) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = "Create a new job";
    } else {
        title.value = "Edit job";
        job.value = id;
        form.category_id = category_id;
        form.client_id = client_id;
        form.title = titleData;
        form.logo_url = logo_url;
        form.color = color;
        form.file = file;
        form.project_name = project_name;
        form.technologies = technologies.map(tech => tech.id);
        form.preview = preview;
        form.body = body;
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
        <div class="flex justify-end">
            <PrimaryButton class="sm:w-auto w-full" @click="openModal(1)">
                <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
                Add job
            </PrimaryButton>
        </div>

        <DialogModal :show="modal" :maxWidth="'6xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                            <div class="sm:col-span-3">
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" ref="titleInput" v-model="form.title" type="text" />

                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="color" value="Color" />

                                <ColorPicker v-model="form.color" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <Images v-model="form.file" :file="form.file" />

                                <InputError :message="form.errors.file" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="category_id" value="Category" />
                                <VueSelect id="category_id" label="name" v-model="form.category_id" :append="true"
                                    :options="categoriesOptions" :reduce="categoriesOptions => categoriesOptions.id"
                                    :select-on-tab="true" />

                                <InputError :message="form.errors.category_id" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="client_id" value="Client" />
                                <VueSelect id="client_id" label="name" v-model="form.client_id" :append="true"
                                    :options="clientOptions" :reduce="clientOptions => clientOptions.id"
                                    :select-on-tab="true" />

                                <InputError :message="form.errors.client_id" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="project_name" value="Proyect name" />
                                <TextInput id="project_name" ref="proyectNameInput" v-model="form.project_name"
                                    type="text" />

                                <InputError :message="form.errors.project_name" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="technologies" value="Technologies" />
                                <VueSelect id="technology_id" label="name" :append="true" :multiple="true"
                                    :close-on-select="false" :options="technologyOptions" v-model="form.technologies"
                                    :reduce="technologyOptions => technologyOptions.id" :value="form.technologies.id" :select-on-tab="true">
                                </VueSelect>

                                <InputError :message="form.errors.technologies" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <InputLabel for="preview" value="Preview" class="mb-3" />
                                <Ckeditor v-model="form.preview" :idData="job" :additionalPath="'/preview'" :urlName="urlCkeditorStoreImage" :value="form.preview" id="preview" ref="previewInput" key="preview" />

                                <InputError :message="form.errors.preview" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <InputLabel for="body" value="Body" class="mb-3" />
                                <Ckeditor v-model="form.body" :idData="job" :additionalPath="'/body'" :urlName="urlCkeditorStoreImage" :value="form.body" id="body" ref="bodyInput" key="body" />

                                <InputError :message="form.errors.body" class="mt-2" />
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