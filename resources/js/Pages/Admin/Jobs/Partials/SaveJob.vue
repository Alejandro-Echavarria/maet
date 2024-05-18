<script setup>
import { ref, onMounted, onBeforeMount, onBeforeUnmount } from "vue";
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
import CurrencyInput from "@/Components/Main/Admin/Components/Forms/Inputs/TextInput/CurrencyInput.vue";
import ToggleSwitch from "@/Components/Main/Admin/Components/Forms/Inputs/ToggleSwitch/ToggleSwitch.vue";
import Ckeditor from "@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue";
import CKeditorHelper from "@/Helpers/CKeditor/Ckeditor";
import ModalErrorAlert from "@/Components/Main/Admin/Components/OtherComponents/ModalErrorAlert.vue";

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

onMounted(() => {
    CKeditorHelper();
});

onBeforeMount(() => {
    window.addEventListener('beforeunload', beforeWindowUnload)
});

onBeforeUnmount(() => {
    window.removeEventListener('beforeunload', beforeWindowUnload)
});

const title = ref("");
const modal = ref(false);
const opration = ref(1);
const job = ref(null);
const closeOpenModal = ref(true);
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
    price: "",
    alt_banner_image: "",
    is_published: false,
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
                closeOpenModal.value = true;
                ok("Job created successfully");
            },
            onError: (errors) => {
                if (errors.create) {
                    closeOpenModal.value = false;
                    ok(errors.create, 'error', null, false, 'Error');
                }
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
                closeOpenModal.value = true;
                ok("Job updated successfully");
            },
            onError: (errors) => {
                if (errors.update) {
                    closeOpenModal.value = false;
                    ok(errors.update, 'error', null, false, 'Error');
                }
            },
        });
    }
};

const openModal = (op, id, category_id, client_id, titleData, slug, logo_url, color, file, project_name, link, technologies, preview, body, price, alt_banner_image, is_published) => {
    modal.value = true;
    closeOpenModal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = "Create a new job";
        form.category_id = "";
        form.client_id = "";
        form.title = "";
        form.slug = "";
        form.logo_url = "";
        form.color = "gray-100";
        form.file = null;
        form.project_name = "";
        form.link = "";
        form.technologies = [];
        form.preview = "";
        form.body = "";
        form.price = "";
        form.alt_banner_image = "";
        form.is_published = false;
        form.defaults();
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
        form.price = price;
        form.alt_banner_image = alt_banner_image;
        form.is_published = is_published;
        form.defaults();
    }
};

const closeModal = () => {
    if (form.isDirty && !form.recentlySuccessful) {
        let answer = window.confirm('Do you really want to leave? you have unsaved changes!');

        if (answer) {
            modal.value = false;
            form.clearErrors();
            form.reset();
        } else {
            return false;
        }
    }

    modal.value = false;
    form.clearErrors();
    form.reset();
};

const confirmLeave = () => {
    return window.confirm('Do you really want to leave? you have unsaved changes!')
};

const confirmStayInDirtyForm = () => {
    return form.isDirty && !confirmLeave()
};

const beforeWindowUnload = (e) => {
    if (confirmStayInDirtyForm()) {
        // Cancel the event
        e.preventDefault()
        // Chrome requires returnValue to be set
        e.returnValue = ''
    }
}

const ok = (msj, type, timer, toast, title) => {
    closeOpenModal.value && closeModal();
    SaveAlert(msj, type, timer, toast, title);
};

defineExpose({ openModal });
</script>

<template>
    <div>
        <div class="flex justify-end">
            <PrimaryButton class="sm:w-auto w-full" @click="openModal(1)">
                <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
                Add
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
                                    <InputLabel for="price" value="Price" />
                                    <CurrencyInput id="price" ref="PriceInput" v-model="form.price" />

                                    <InputError :message="form.errors.price" class="mt-2" />
                                </div>

                                <div>
                                    <InputLabel for="is_published" value="Publish" />
                                    <ToggleSwitch id="is_published" ref="is_publishedInput" v-model="form.is_published" class="mt-2" />

                                    <InputError :message="form.errors.is_published" class="mt-2" />
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
                    <ModalErrorAlert :errors="form.errors" />

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