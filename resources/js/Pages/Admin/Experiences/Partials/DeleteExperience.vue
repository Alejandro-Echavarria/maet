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
            form.delete(route('admin.resume.experiences.destroy', id), {
                preserveScroll: true,
                onSuccess: () => {
                    ok('Experience deleted successfully');
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
    <div class="mr-2 flex items-center cursor-pointer">
        <font-awesome-icon @click="destroy(id)" :icon="['far', 'trash-can']" :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing" class="w-4 h-4 text-red-500" />
    </div>
</template>