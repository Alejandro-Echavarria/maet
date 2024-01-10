<script setup>
import { useForm } from '@inertiajs/vue3';
import SaveAlert from '@/Helpers/Alerts/SaveAlert';
import DeleteAlert from '@/Helpers/Alerts/DeleteAlert';

const props = defineProps({
    id: Number,
});

const form = useForm({
    id: props.id
});

const destroy = (id) => {
    DeleteAlert().then((result) => {
        if (result.isConfirmed) {
            form.delete(route('admin.jobs.destroy', id), {
                preserveScroll: true,
                onSuccess: () => {
                    ok('Job deleted successfully');
                },
                onError: () => {
                    console.log('error');
                },
            });
        }
    });
};

const ok = (msj, type, timer) => {
    SaveAlert(msj, type, timer);
};
</script>

<template>
    <button @click="destroy(id)" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
        class="w-8 h-8 shrink-0 text-gray-700 bg-gray-200/60 rounded-full hover:text-red-500 hover:bg-red-200/60 transition duration-300">
        <font-awesome-icon :class="['w-4 h-4']" :icon="['fas', 'xmark']" />
    </button>
</template>