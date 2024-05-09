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
import VueSelect from "@/Components/Main/Admin/Components/Selects/VueSelect.vue";

const props = defineProps({
    data: Object,
    filter: String,
    page: String
});

const nameInput = ref(null);
const title = ref('');
const modal = ref(false);
const category = ref(null);
const opration = ref(1);
const companyTypesOptions = ref(props.data.companyTypes);

const form = useForm({
    name: '',
});


const openModal = (op, slug, name) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = 'Create a new company';
    } else {
        title.value = 'Edit company';
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
                            <div class="md:col-span-3">
                                <InputLabel for="name" value="Name" />
                                <TextInput v-model="form.name" id="name" ref="nameInput" type="text" />

                                <InputError :message="form.errors.name" class="mt-2" />
                                <InputError :message="form.errors.slug" class="mt-2" />
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
                                <TextInput v-model="form.taxt_id_number" id="taxt_id_number" ref="taxtIdNumberInput" type="text" />

                                <InputError :message="form.errors.taxt_id_number" class="mt-2" />
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="company_type_id" value="Company type" />
                                <VueSelect id="company_type_id" label="name" v-model="form.company_type_id" :append="true"
                                    :options="companyTypesOptions" :reduce="companyTypesOptions => companyTypesOptions.id"
                                
                                    :select-on-tab="true" />

                                <InputError :message="form.errors.category_id" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <InputLabel for="zip_code" value="Zip code" />
                                <TextInput v-model="form.zip_code" id="zip_code" ref="zipCodeInput" type="text" />

                                <InputError :message="form.errors.zip_code" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="country" value="Country" />
                                <TextInput v-model="form.country" id="country" ref="countryInput" type="text" />

                                <InputError :message="form.errors.country" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="state" value="State" />
                                <TextInput v-model="form.state" id="state" ref="stateInput" type="text" />

                                <InputError :message="form.errors.state" class="mt-2" />
                            </div>

                            <div class="md:col-span-5">
                                <InputLabel for="street" value="Street" />
                                <TextInput v-model="form.street" id="street" ref="streetInput" type="text" />

                                <InputError :message="form.errors.street" class="mt-2" />
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