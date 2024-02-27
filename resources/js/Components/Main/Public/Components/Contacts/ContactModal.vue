<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import SimpleForm from "@/Components/Main/Admin/Components/Forms/SimpleForm.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SaveAlert from "@/Helpers/Alerts/SaveAlert";

const props = defineProps({
    message: {
        type: String,
        default: "put a text"
    }
});

const title = ref("");
const modal = ref(false);

const form = useForm({
    name: "",
    email: "",
    message: "",
});

const openModal = (name, email, message) => {
    modal.value = true;
    title.value = "Get in touch";
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
        <div>
            <PrimaryButton class="sm:w-auto w-full" @click="openModal(1)">
                {{ message }}
            </PrimaryButton>
        </div>

        <DialogModal :show="modal" :maxWidth="'3xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <SimpleForm :actions="true" @submitted="save">
                    <template #form>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="sm:col-span-3">
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" ref="altBannerImageInput" v-model="form.name"
                                    type="text" placeholder="Working in this feature" />

                                <InputError :message="form.errors.name" class="mt-2" />
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
                    Send
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>
