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
import Ckeditor from '@/Components/Main/Public/Components/Forms/Inputs/Ckeditor/Ckeditor.vue';
import CKeditorHelper from "@/Helpers/CKeditor/Ckeditor";

const props = defineProps({
    message: {
        type: String,
        default: "put a text"
    },
});

const title = ref("");
const modal = ref(false);

const form = useForm({
    name: "",
    email: "",
    message: "",
});

const openModal = () => {
    CKeditorHelper(true);
    modal.value = true;
    title.value = "Get in touch";
};

const save = () => {
    form.post(route('contactus.store'), {
        preserveScroll: true,
        onSuccess: () => {
            ok('Message sent successfully');
        },
        onError: () => {
            console.log('error');
        }
    });
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
        <div>
            <PrimaryButton class="sm:w-auto w-full" @click="openModal">
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
                                <TextInput id="name" ref="nameInput" v-model="form.name" type="text" placeholder="Name" />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="sm:col-span-3">
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" ref="emailInput" v-model="form.email" type="email"
                                    placeholder="Email" />

                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="sm:col-span-3 h-11">
                                <InputLabel for="message" value="Message" class="mb-2" />
                                <Ckeditor :needTimeToLoad="true" id="message" idname="message" v-model="form.message" :value="form.message"
                                    key="message" ref="messageInput">
                                    <div id="ckeditormessage"></div>
                                </Ckeditor>

                                <InputError :message="form.errors.message" class="mt-2" />
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
