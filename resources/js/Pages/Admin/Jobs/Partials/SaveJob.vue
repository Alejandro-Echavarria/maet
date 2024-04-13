<script setup>
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SaveAlert from "@/Helpers/Alerts/SaveAlert";
import SimpleForm from "@/Components/Main/Admin/Components/Forms/SimpleForm.vue";
import ColorPicker from "@/Components/Main/Admin/Components/Forms/Inputs/SelectsPicker/ColorsPicker/ColorPicker.vue";
import VueSelect from "@/Components/Main/Admin/Components/Selects/VueSelect.vue";
import Images from "@/Components/Main/Admin/Components/Forms/Inputs/Images/Images.vue";
import ToggleSwitch from "@/Components/Main/Admin/Components/Forms/Inputs/ToggleSwitch/ToggleSwitch.vue";
import Ckeditor from "@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue";
import CKeditorHelper from "@/Helpers/CKeditor/Ckeditor";

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

onMounted(() => {
    CKeditorHelper();
});

const title = ref("");
const modal = ref(false);
const opration = ref(1);
const job = ref(null);
const categoriesOptions = ref(props.data.categories);
const clientOptions = ref(props.data.clients);
const technologyOptions = ref(props.data.technologies);
const urlCkeditorStoreImage = 'admin.ckeditor.images.job.movetostorage';

const form = useForm({
    category_id: "",
    client_id: "",
    title: "",
    slug: "",
    logo_url: "",
    color: "gray-100",
    file: null,
    project_name: "",
    link: "",
    technologies: [],
    preview: "",
    body: "",
    alt_banner_image: "",
    status: false,
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

const openModal = (op, id, category_id, client_id, titleData, slug, logo_url, color, file, project_name, link, technologies, preview, body, alt_banner_image, status) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = "Create a new job";
    } else {
        title.value = "Edit job";
        job.value = slug;
        form.category_id = category_id;
        form.client_id = client_id;
        form.title = titleData;
        form.slug = slug;
        form.logo_url = logo_url;
        form.color = color;
        form.file = file;
        form.project_name = project_name;
        form.link = link;
        form.technologies = technologies.map(tech => tech.id);
        form.preview = preview;
        form.body = body;
        form.alt_banner_image = alt_banner_image;
        form.status = status;
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
                                <div class="flex">
                                    <InputLabel for="title" value="Title" />
                                    <div v-if="form.slug">
                                        <span class="text-gray-500 text-xs">
                                            &nbsp; (<span class="font-bold">slug:</span> {{ form.slug }})
                                        </span>
                                    </div>
                                </div>
                                <TextInput id="title" ref="titleInput" v-model="form.title" type="text" />

                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="color" value="Color" />

                                <ColorPicker v-model="form.color" />

                                <InputError :message="form.errors.color" class="mt-2" />
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="project_name" value="Project description SEO" />
                                <TextInput id="project_name" ref="projectNameInput" v-model="form.project_name"
                                    type="text" />

                                <InputError :message="form.errors.project_name" class="mt-2" />
                            </div>

                            <div class="sm:col-span-1">
                                <InputLabel for="link" value="Link" />
                                <TextInput id="link" ref="linkInput" v-model="form.link" type="url"
                                    placeholder="https://example.com" />

                                <InputError :message="form.errors.link" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <Images v-model="form.file" :file="form.file" />

                                <InputError :message="form.errors.file" class="mt-2" />
                            </div>

                            <div class="flex items-center sm:col-span-4 gap-6">
                                <div class="grow">
                                    <InputLabel for="alt_banner_image" value="Alt banner image" />
                                    <TextInput id="alt_banner_image" ref="altBannerImageInput"
                                        v-model="form.alt_banner_image" type="text" />

                                    <InputError :message="form.errors.alt_banner_image" class="mt-2" />
                                </div>

                                <div>
                                    <InputLabel for="status" value="Publish" />
                                    <ToggleSwitch id="status" ref="statusInput" v-model="form.status" class="mt-2" />

                                    <InputError :message="form.errors.status" class="mt-2" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="category_id" value="Category" />
                                <VueSelect id="category_id" label="name" v-model="form.category_id" :append="true"
                                    :options="categoriesOptions" :reduce="categoriesOptions => categoriesOptions.id"
                                    :select-on-tab="true" />

                                <InputError :message="form.errors.category_id" class="mt-2" />
                            </div>

                            <div class="sm:col-span-2">
                                <InputLabel for="technologies" value="Technologies" />
                                <VueSelect id="technology_id" label="name" :append="true" :multiple="true"
                                    :close-on-select="false" :options="technologyOptions" v-model="form.technologies"
                                    :reduce="technologyOptions => technologyOptions.id" :value="form.technologies.id"
                                    :select-on-tab="true">
                                </VueSelect>

                                <InputError :message="form.errors.technologies" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <InputLabel for="client_id" value="Client" />
                                <VueSelect id="client_id" label="name" v-model="form.client_id" :append="true"
                                    :options="clientOptions" :reduce="clientOptions => clientOptions.id"
                                    :select-on-tab="true" />

                                <InputError :message="form.errors.client_id" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <InputLabel for="preview" value="Preview" class="mb-2" />
                                <Ckeditor id="preview" idname="preview" v-model="form.preview" :idData="job"
                                    :additionalPath="'/preview'" :urlName="urlCkeditorStoreImage" :value="form.preview"
                                    key="preview" ref="previewInput">
                                    <div id="ckeditorpreview"></div>
                                </Ckeditor>

                                <InputError :message="form.errors.preview" class="mt-2" />
                            </div>

                            <div class="sm:col-span-4">
                                <InputLabel for="body" value="Body" class="mb-2" />
                                <Ckeditor id="body" idname="body" v-model="form.body" :idData="job"
                                    :additionalPath="'/body'" :urlName="urlCkeditorStoreImage" :value="form.body"
                                    key="body" ref="bodyInput">
                                    <div id="ckeditorbody"></div>
                                </Ckeditor>

                                <InputError :message="form.errors.body" class="mt-2" />
                            </div>
                        </div>
                    </template>
                </SimpleForm>
            </template>

            <template #footer>
                <div class="flex justify-end w-full">
                    <div class="shrink-0 mr-3" :class="Object.keys(form.errors).length > 0 ? 'flex' : 'hidden'"
                        :title="'Existen ' + Object.keys(form.errors).length + ' errores'">
                        <div class="bg-gray-200 h-full p-2 rounded-full flex items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 animate-pulse"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 1.67c.955 0 1.845.467 2.39 1.247l.105.16l8.114 13.548a2.914 2.914 0 0 1-2.307 4.363l-.195.008H3.882a2.914 2.914 0 0 1-2.582-4.2l.099-.185l8.11-13.538A2.914 2.914 0 0 1 12 1.67M12.01 15l-.127.007a1 1 0 0 0 0 1.986L12 17l.127-.007a1 1 0 0 0 0-1.986zM12 8a1 1 0 0 0-.993.883L11 9v4l.007.117a1 1 0 0 0 1.986 0L13 13V9l-.007-.117A1 1 0 0 0 12 8" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <SecondaryButton @click="closeModal" class="mr-3">
                        Close
                    </SecondaryButton>

                    <PrimaryButton form="simpleForm" type="submit" @click="save"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </PrimaryButton>
                </div>
            </template>
        </DialogModal>
    </div>
</template>