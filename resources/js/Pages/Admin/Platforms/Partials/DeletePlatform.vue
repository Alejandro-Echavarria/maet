<script setup>
import { useForm } from '@inertiajs/vue3';
import TableButton from '@/Components/Main/Admin/Components/Buttons/TableButton.vue';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import DeleteAlert from '@/Helpers/Alerts/DeleteAlert';

const props = defineProps({
    id: Number,
    filter: String,
    page: String,
});

const form = useForm({
    id: props.id
});

const ok = (msj, type, timer) => {
    SaveAlert(msj, type, timer);
};

const destroy = (id) => {
    DeleteAlert().then((result) => {
        if (result.isConfirmed) {
            form.transform((data) => ({
                ...data,
                search: props.filter,
                page: props.page
            })).delete(route('admin.usersocialmedias.destroy', id), {
                preserveScroll: true,
                onSuccess: () => {
                    ok('User social media deleted susccessfully');
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