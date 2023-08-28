<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const props = defineProps({
    socialMedias: Object,
});

const title = ref('');
const modal = ref(false);
const opration = ref(1);
const options = ref(
    props.socialMedias
);

const form = useForm({
    socialMedia: '',
    url: '',
});

const save = () => {
    if (opration.value === 1) {

        alert(form.socialMedia);
        return false;
        form.post(route('admin.socialmedias.store'), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Social media created successfully');
            },
            onError: () => {
                if (form.errors.name) {
                    nameInput.value.focus();
                }

                if (form.errors.icon) {
                    iconInput.value.focus();
                }
            }
        });
    } else {
        form.put(route('admin.socialmedias.update', socialMedia.value), {
            preserveScroll: true,
            onSuccess: () => {
                ok('Social media updated successfully');
            },
            onError: () => {
                if (form.errors.name) {
                    nameInput.value.focus();
                }

                if (form.errors.icon) {
                    iconInput.value.focus();
                }
            }
        });
    }
};

const openModal = (op, id, icon, name) => {
    modal.value = true;
    opration.value = op;

    if (op == 1) {
        title.value = 'Create a new social media';
    } else {
        title.value = 'Edit social media';
        socialMedia.value = id;
        form.icon = icon;
        form.name = name;
    }
};

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <div>
        <!-- <pre>
            {{ options }}
        </pre> -->
        <PrimaryButton @click="openModal(1)">
            <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
            Add social media
        </PrimaryButton>
        <DialogModal :show="modal" :maxWidth="'2xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <InputLabel for="icon" value="Social media" />
                    <!-- <TextInput v-model="form.icon" id="icon" ref="iconInput" type="text" placeholder="fas-user" /> -->
                    <v-select
                        label="name"
                        v-model="form.socialMedia"
                        :options="options"
                        :reduce="options => options.id"
                        :select-on-tab="true"
                        class="mt-3 style-chooser"
                        placeholder="Selecciona una opción"
                    >
                    </v-select>
                    <!-- <InputError :message="form.errors.icon" class="mt-2" /> -->
                </div>

                <div class="mt-4">
                    <InputLabel for="name" value="URL" />
                    <TextInput v-model="form.url" id="name" ref="urlInput" type="url" placeholder="https://example.com" />

                    <!-- <InputError :message="form.errors.name" class="mt-2" /> -->
                </div>
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

<style>
.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    color: #747474;
    text-transform: lowercase;
    font-variant: small-caps;
    border: 2px solid #e5e7eb;
    border-radius: 0px 0px 8px 8px;
    margin-top: -4px;
    box-shadow: none;
}

.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
}

.style-chooser .vs__search {
    padding-bottom: 3px;
}


.style-chooser .vs__dropdown-menu,
.style-chooser .vs__dropdown-max-height {
    max-height: 130px;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
    fill: #5145cd;
}
</style>
