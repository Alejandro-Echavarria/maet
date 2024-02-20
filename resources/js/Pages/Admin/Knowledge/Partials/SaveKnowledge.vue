<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SimpleForm from "@/Components/Main/Admin/Components/Forms/SimpleForm.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import IconTextInput from "@/Components/Main/Admin/Components/Forms/Inputs/TextInput/IconTextInput.vue";
import ToggleSwitch from "@/Components/Main/Admin/Components/Forms/Inputs/ToggleSwitch/ToggleSwitch.vue";
import InputError from "@/Components/InputError.vue";
import SaveAlert from "@/Helpers/Alerts/SaveAlert";

const props = defineProps({
    data: Object,
});

const title = ref("");
const modal = ref(false);
const opration = ref(1);
const knowledge = ref(null);

const form = useForm({
    title: "",
    icon: "",
    main: false,
});

const save = () => {
    if (opration.value === 1) {
        form.post(route("admin.resume.knowledge.store"), {
            preserveScroll: true,
            onSuccess: () => {
                ok("Knowledge created successfully");
            },
            onError: () => {
                console.log("error");
            },
        });
    } else {
        form.put(route("admin.resume.knowledge.update", knowledge.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok("Knowledge updated successfully");
            },
            onError: () => {
                console.log("error");
            },
        });
    }
};

const openModal = (op, id, titleData, icon, main) => {
    modal.value = true;
    opration.value = op;

    if (op === 1) {
        title.value = "Create a new knowledge";
    } else {
        title.value = "Edit knowledge";
        knowledge.value = id;
        form.title = titleData;
        form.icon = icon;
        form.main = main;
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
                Add knowledge
            </PrimaryButton>
        </div>

        <DialogModal :show="modal" :maxWidth="'2xl'" @close="closeModal">
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

                            <div class="flex items-center sm:col-span-3 gap-6">
                                <div class="grow">
                                    <InputLabel for="icon" value="Icon" />
                                    <IconTextInput id="icon" ref="iconInput" v-model="form.icon" />
    
                                    <InputError :message="form.errors.icon" class="mt-2" />
                                </div>

                                <div>
                                    <InputLabel for="main" value="Main" />
                                    <ToggleSwitch id="main" ref="mainInput" v-model="form.main" class="mt-2" />
    
                                    <InputError :message="form.errors.main" class="mt-2" />
                                </div>
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