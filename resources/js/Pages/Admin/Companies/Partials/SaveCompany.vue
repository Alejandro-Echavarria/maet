<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Images from "@/Components/Main/Admin/Components/Forms/Inputs/Images/Images.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import VueSelect from "@/Components/Main/Admin/Components/Selects/VueSelect.vue";
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

const nameInput = ref(null);
const title = ref('');
const modal = ref(false);
const closeOpenModal = ref(true);
const opration = ref(1);
const company = ref(null);
const companyTypesOptions = ref(props.data.companyTypes);

const form = useForm({
    company_type_id: null,
    slug: '',
    name: '',
    bio: '',
    taxt_id_number: null,
    country: '',
    city: '',
    state: '',
    street: '',
    zip_code: '',
    email: '',
    phone: '',
    banner_file: null,
    logo_file: null,
});

const save = () => {
    if (opration.value === 1) {
        form.transform((data) => ({
            ...data,
            search: props.filter,
            page: props.page
        })).post(route("admin.companies.store"), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                ok("Company created");
            },
            onError: (errors) => {
                if (errors.create) {
                    closeOpenModal.value = false;
                    ok(errors.create, 'error', null, false, 'Error');
                }
            }
        });
    } else {
        form.transform((data) => ({
            ...data,
            _method: 'put',
            search: props.filter,
            page: props.page,
        })).post(route("admin.companies.update", company.value), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                ok("Company updated");
            },
            onError: (errors) => {
                if (errors.update) {
                    closeOpenModal.value = false;
                    ok(errors.update, 'error', null, false, 'Error');
                }
            }
        });
    }
};

const openModal = (op, data) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new company';
    } else {
        title.value = 'Edit company';
        company.value = data.slug;
        form.company_type_id = data.company_type_id;
        form.slug = data.slug;
        form.name = data.name;
        form.bio = data.bio;
        form.taxt_id_number = data.taxt_id_number;
        form.country = data.country;
        form.city = data.city;
        form.state = data.state;
        form.street = data.street;
        form.zip_code = data.zip_code;
        form.email = data.email;
        form.phone = data.phone;

        const bannerImage = data.images.find(image => image.file_type === 'banner_file');
        const logoImage = data.images.find(image => image.file_type === 'logo_file');

        form.banner_file = bannerImage ? bannerImage.url : null;
        form.logo_file = logoImage ? logoImage.url : null;
    }

    setTimeout(() => nameInput.value.focus(), 250);
};

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
};

const ok = (msj, type, timer, toast, title) => {
    closeOpenModal.value && closeModal();
    SaveAlert(msj, type, timer, toast, title);
};

defineExpose({ openModal });
</script>

<template>
    <div>
        <PrimaryButton class="w-full" @click="openModal(1)">
            <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
            Add company
        </PrimaryButton>

        <DialogModal :show="modal" :maxWidth="'5xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 md:grid-cols-9 gap-6">
                            <div class="md:col-span-9">
                                <InputLabel for="banner_file" value="Banner" />
                                <Images id="banner_file" v-model="form.banner_file" :file="form.banner_file" />

                                <InputError :message="form.errors.banner_file" class="mt-2" />
                            </div>

                            <div class="flex flex-col md:flex-row items-center md:col-span-6 gap-6">
                                <div class="flex flex-col md:flex-row items-center gap-2">
                                    <InputLabel for="logo_file" value="Logo" />

                                    <Images id="logo_file" v-model="form.logo_file" :file="form.logo_file"
                                        typeImage="clients" />
                                    <InputError :message="form.errors.logo_file" class="mt-2" />
                                </div>

                                <div class="grow w-full">
                                    <InputLabel for="name" value="Name" />
                                    <TextInput v-model="form.name" id="name" ref="nameInput" type="text" />

                                    <InputError :message="form.errors.name" class="mt-2" />
                                    <InputError :message="form.errors.slug" class="mt-2" />
                                </div>
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="email" value="Email" />
                                <TextInput v-model="form.email" id="email" ref="emailInput" type="text" />

                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="phone" value="Phone" />
                                <TextInput v-model="form.phone" id="phone" ref="phoneInput" type="text" />

                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="taxt_id_number" value="Taxt id number" />
                                <TextInput v-model="form.taxt_id_number" id="taxt_id_number" ref="taxtIdNumberInput"
                                    type="text" />

                                <InputError :message="form.errors.taxt_id_number" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="company_type_id" value="Company type" />
                                <VueSelect id="company_type_id" label="name" v-model="form.company_type_id"
                                    :append="true" :options="companyTypesOptions"
                                    :reduce="companyTypesOptions => companyTypesOptions.id" :select-on-tab="true" />

                                <InputError :message="form.errors.company_type_id" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="zip_code" value="Zip code" />
                                <TextInput v-model="form.zip_code" id="zip_code" ref="zipCodeInput" type="text" />

                                <InputError :message="form.errors.zip_code" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="country" value="Country" />
                                <TextInput v-model="form.country" id="country" ref="countryInput" type="text" />

                                <InputError :message="form.errors.country" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="city" value="City" />
                                <TextInput v-model="form.city" id="city" ref="cityInput" type="text" />

                                <InputError :message="form.errors.city" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="state" value="State" />
                                <TextInput v-model="form.state" id="state" ref="stateInput" type="text" />

                                <InputError :message="form.errors.state" class="mt-2" />
                            </div>

                            <div class="md:col-span-6">
                                <InputLabel for="street" value="Street" />
                                <TextInput v-model="form.street" id="street" ref="streetInput" type="text" />

                                <InputError :message="form.errors.street" class="mt-2" />
                            </div>

                            <div class="md:col-span-9">
                                <InputLabel for="body" value="Body" class="mb-2" />
                                <Ckeditor id="body" idname="body" v-model="form.bio" :idData="company"
                                    :additionalPath="'/company'" :urlName="urlCkeditorStoreImage" :value="form.bio"
                                    key="bio" ref="bioInput">
                                    <div id="ckeditorbody"></div>
                                </Ckeditor>

                                <InputError :message="form.errors.bio" class="mt-2" />
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