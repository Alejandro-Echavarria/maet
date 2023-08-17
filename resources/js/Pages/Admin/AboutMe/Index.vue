<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import MainTable from '@/Components/Main/Admin/Components/Tables/MainTable.vue';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import VueMultiselect from 'vue-multiselect';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';


const title = ref('');
const modal = ref(false);
const opration = ref(1);

const value = ref('');
const selected = ref(null);
const source = ref(['Select option', 'options', 'selected', 'multiple', 'label', 'searchable', 'clearOnSelect', 'hideSelected', 'maxHeight', 'allowEmpty', 'showLabels', 'onChange', 'touched']);

const form = useForm({
    icon: '',
    url: ''
});

const thead = ref(['social media', 'url', 'created', 'updated']);

const store = () => {
    createForm.post(route('admin.aboutme.store'), {
        errorBag: 'createSocialMedia',
        preserveScroll: true
    });
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

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    userSocialMedias: Object,
});
</script>

<template>
    <Head title="User social medias" />

    <div>
        <MainTitle>
            User social medias
        </MainTitle>

        <MainTable>
            <template #createButton>
                <PrimaryButton @click="openModal(1)">
                    <font-awesome-icon class="mr-2" :icon="['fas', 'plus']" />
                    Add social media
                </PrimaryButton>
            </template>

            <template #thead>
                <th v-for="(th, key) in thead" scope="col" class="px-4 py-3" :key="key + 'th'">
                    {{ th }}
                </th>
            </template>

            <template #tbody>
                <tr v-for="tb in userSocialMedias.data"
                    class="dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-linear duration-300"
                    :key="tb.id + 'tb'">
                    <td class="px-4 py-3">{{ tb.social_media_id }}</td>
                    <td class="px-4 py-3">{{ tb.url }}</td>
                    <td class="px-4 py-3">{{ tb.created_at }}</td>
                    <td class="px-4 py-3">{{ tb.updated_at }}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <!-- <TableButton>
                            <font-awesome-icon @click="openModal(2, tb.id, tb.icon, tb.name)"
                                class="w-4 h-4 text-indigo-500" :icon="['far', 'pen-to-square']" />
                        </TableButton>
                        <TableButton>
                            <font-awesome-icon @click="destroy(tb.id)" class="w-4 h-4 text-red-500"
                                :icon="['far', 'trash-can']" />
                        </TableButton> -->
                    </td>
                </tr>
            </template>
        </MainTable>

        <DialogModal :show="modal" :maxWidth="'2xl'" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <InputLabel for="icon" value="Social media" />
                    <!-- <TextInput v-model="form.icon" id="icon" ref="iconInput" type="text" placeholder="fas-user" /> -->
                    <VueMultiselect v-model="value" :options="source" class="bg-blue-7000">
                        <template #singleLabel>
                            <span class="option__title bg-slate-500" slot-scope="props">hola4</span>
                        </template>
                        <template slot="option" slot-scope="props">
                            <div class="option__desc bg-slate-500"><span class="option__title">hola2</span><span
                                    class="option__small">hola2</span></div>
                        </template>
                    </VueMultiselect>

                    <v-select :options="['Canada', 'United States', 'United States', 'United States', 'United States']">
                    </v-select>

                    {{ value }}
                    <!-- <InputError :message="form.errors.icon" class="mt-2" /> -->
                </div>

                <div class="mt-4">
                    <InputLabel for="name" value="URL" />
                    <TextInput v-model="form.url" id="name" ref="urlInput" type="url" />

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
<style src="vue-multiselect/dist/vue-multiselect.css"></style>