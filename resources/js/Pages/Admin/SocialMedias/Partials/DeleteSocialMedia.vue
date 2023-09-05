<script setup>
import { useForm } from '@inertiajs/vue3';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    id: Number,
    filter: String,
    page: String,
});

const form = useForm({
    id: props.id
});

const ok = (msj, type = 'success', timer = 10000) => {
    Swal.fire({
        icon: type,
        title: msj,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        padding: '0.4em',
        showCloseButton: true,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
}

const destroy = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        focusCancel: true,
        customClass: {
            confirmButton: 'ml-2 inline-flex items-center place-content-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
            cancelButton: 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150'
        },
        buttonsStyling: false,
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.transform((data) => ({
                ...data,
                search: props.filter,
                page: props.page
            })).delete(route('admin.socialmedias.destroy', id), {
                preserveScroll: true,
                onSuccess: () => {
                    ok('Social media deleted successfully');
                },
                onError: () => {
                    console.log('error');
                },
            });
        }
    });
};
</script>

<template>
    <TableButton>
        <font-awesome-icon @click="destroy(id)" :icon="['far', 'trash-can']" :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing" class="w-4 h-4 text-red-500" />
    </TableButton>
</template>