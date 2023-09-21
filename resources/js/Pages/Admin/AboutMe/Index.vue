<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted } from 'vue';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
import SimpleForm from '@/Components/Main/Admin/Components/Forms/SimpleForm.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import Datepicker from 'flowbite-datepicker/Datepicker';
import Ckeditor from '@/Components/Main/Admin/Components/Forms/Inputs/ckeditor/Ckeditor.vue';

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    auth: Object
});

onMounted(() => {
    const datedatepickerId2pickerEl = document.querySelector('#datepickerId');

    new Datepicker(datedatepickerId2pickerEl, {
        autohide: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });
});

onUnmounted(() => {
    const datedatepickerId2pickerEl = document.querySelector('.datepicker');

    datedatepickerId2pickerEl.remove();
});

const form = useForm({
    position: props.auth.user.position,
    bio: props.auth.user.bio,
    address: props.auth.user.address,
    phone: props.auth.user.phone,
    birthday: props.auth.user.birthday
});

const save = () => {
    const datedatepickerId2pickerEl = document.querySelector('#datepickerId');

    form.transform((data) => ({
        ...data,
        birthday: datedatepickerId2pickerEl.value
    })).put(route('admin.aboutme.update', props.auth.user.id), {
        preserveScroll: true,
        onSuccess: () => {
            ok('Your ifnormation was updated successfully');
        },
        onError: () => {

        }
    });
};

const ok = (msj, type, timer) => {
    SaveAlert(msj, type, timer);
};
</script>

<template>
    <Head title="About me" />

    <div>
        <MainTitle>
            About me
        </MainTitle>

        <div class="flex w-auto mb-4">
            <Link :href="route('profile.show')">
            <p class="text-indigo-700 text-md hover:text-indigo-400 transition duration-300">
                Click to change your <span class="font-bold">email</span> and <span class="font-bold">name </span>
                <font-awesome-icon class="w-4 h-4 ml-1" :icon="['fas', 'user-pen']" />
            </p>
            </Link>
        </div>

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
                        <TextInput v-model="form.phone" id="phone" ref="phoneInput" type="phone" placeholder="Your phone" />

                        <InputError :message="form.errors.phone" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="birthday" value="Birthday" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <TextInput v-model="form.birthday" datepicker id="datepickerId" ref="datepickerInput"
                                class="pl-7" type="text" placeholder="Your birthday" />

                        </div>
                        <InputError :message="form.errors.birthday" class="mt-2" />
                    </div>

                    <div class="grid-cols-1 sm:col-span-2">
                        <InputLabel for="bio" value="Bio" class="mb-3" />
                        <Ckeditor v-model="form.bio" :value="form.bio" id="bio" ref="bioInput" />

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
