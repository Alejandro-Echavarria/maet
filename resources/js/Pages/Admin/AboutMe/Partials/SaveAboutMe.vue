<script setup>
import { onMounted, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Datepicker from 'flowbite-datepicker/Datepicker';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import Ckeditor from '@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue';
import CKeditorHelper from "@/Helpers/CKeditor/Ckeditor";

const props = defineProps({
    data: Object
});

const form = useForm({
    position: props.data.user.position,
    bio: props.data.user.bio,
    address: props.data.user.address,
    phone: props.data.user.phone,
    birthday: props.data.user.birthday
});

const urlCkeditorStoreImage = 'admin.ckeditor.images.aboutme.movetostorage';

onMounted(() => {
    const datedatepickerId2pickerEl = document.querySelector('#datepickerId');

    new Datepicker(datedatepickerId2pickerEl, {
        autohide: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });

    CKeditorHelper();
});

onUnmounted(() => {
    const datedatepickerId2pickerEl = document.querySelector('.datepicker');

    datedatepickerId2pickerEl.remove();
});

const save = () => {
    const datedatepickerId2pickerEl = document.querySelector('#datepickerId');

    form.transform((data) => ({
        ...data,
        birthday: datedatepickerId2pickerEl.value
    })).put(route('admin.aboutme.update', props.data.user.id), {
        preserveScroll: true,
        onSuccess: () => {
            ok('Your ifnormation was updated successfully');
        },
        onError: () => {
            console.log('error');
        }
    });
};

const ok = (msj, type, timer) => {
    SaveAlert(msj, type, timer);
};
</script>

<template>
    <div>
        <SimpleForm :actions="true" @submitted="save">
            <template #form>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <InputLabel for="position" value="Position" />
                        <TextInput v-model="form.position" id="position" ref="positionInput" type="text"
                            placeholder="Your position" />

                        <InputError :message="form.errors.position" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="address" value="Address" />
                        <TextInput v-model="form.address" id="address" ref="addressInput" type="text"
                            placeholder="Your address" />

                        <InputError :message="form.errors.address" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="phone" value="Phone" />
                        <TextInput v-model="form.phone" id="phone" ref="phoneInput" type="text"
                            placeholder="Your phone" />

                        <InputError :message="form.errors.phone" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="birthday" value="Birthday" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none pl-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <TextInput v-model="form.birthday" datepicker id="datepickerId" ref="datepickerInput"
                                class="pl-9" type="text" placeholder="Your birthday" />

                        </div>
                        <InputError :message="form.errors.birthday" class="mt-2" />
                    </div>

                    <div class="grid-cols-1 sm:col-span-2">
                        <InputLabel for="body" value="Bio" class="mb-3" />

                        <Ckeditor id="body" idname="body" key="body" v-model="form.bio" :value="form.bio"
                            :needTimeToLoad="true" :idData="$page.props.auth.user.id" :additionalPath="'/about-me'"
                            :urlName="urlCkeditorStoreImage" ref="bodyInput">
                            <div id="ckeditorbody"></div>
                        </Ckeditor>

                        <InputError :message="form.errors.bio" class="mt-2" />
                    </div>
                </div>
            </template>

            <template #actions>
                <PrimaryButton class="w-full md:w-auto" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Save
                </PrimaryButton>
            </template>
        </SimpleForm>
    </div>
</template>