<script setup>
// import { Link } from '@inertiajs/vue3';
// import { onMounted, onUnmounted } from 'vue';
import MainLayout from '@/Components/Main/Admin/Layout/MainLayout.vue';
import MainTitle from '@/Components/Main/Admin/Components/Titles/MainTitle.vue';
// import SaveAlert from '@/Helpers/Alerts/SaveAlert';
// import Datepicker from 'flowbite-datepicker/Datepicker';
import SaveAboutMe from '@/Pages/Admin/AboutMe/Partials/SaveAboutMe.vue';
// import CKeditorHelper from "@/Helpers/CKeditor/Ckeditor";

defineOptions({
    layout: MainLayout
});

const props = defineProps({
    auth: Object
});

// onMounted(() => {
//     console.log('estoy squi');
//     const datedatepickerId2pickerEl = document.querySelector('#datepickerId');

//     new Datepicker(datedatepickerId2pickerEl, {
//         autohide: true,
//         format: 'dd/mm/yyyy',
//         todayHighlight: true
//     });

//     // CKeditorHelper();
// });

// onUnmounted(() => {
//     const datedatepickerId2pickerEl = document.querySelector('.datepicker');

//     datedatepickerId2pickerEl.remove();
// });

// const form = useForm({
//     position: props.auth.user.position,
//     bio: props.auth.user.bio,
//     address: props.auth.user.address,
//     phone: props.auth.user.phone,
//     birthday: props.auth.user.birthday
// });



// const ok = (msj, type, timer) => {
//     SaveAlert(msj, type, timer);
// };
// CKeditorHelper();
</script>

<template>
    <!-- <Head>
        <title>About me</title>
    </Head> -->

    <div>
        <MainTitle>
            About me
        </MainTitle>

        <div class="flex w-auto mb-4">
            <!-- <Link :href="route('profile.show')"> -->
            <p class="text-indigo-700 text-md hover:text-indigo-400 transition duration-300">
                Click to change your <span class="font-bold">email</span> and <span class="font-bold">name </span>
                <font-awesome-icon class="w-4 h-4 ml-1" :icon="['fas', 'user-pen']" />
            </p>
            <!-- </Link> -->
        </div>

        <SaveAboutMe :data="auth" />

    </div>
</template>
