<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    idname: {
        type: String,
    },
    modelValue: {
        type: String,
        default: '',
    },
    needTimeToLoad: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue']);
const value = ref(props.modelValue ? props.modelValue : '');

onMounted(() => {
    setTimeout(() => {
        BalloonEditor
            .create(document.querySelector('#ckeditor' + props.idname), {
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'bulletedList', 'numberedList', '|', 'alignment', 'indent', 'outdent', '|', 'insertTable'],
                placeholder: 'Start typing and select for more features',
                language: 'es, en',
            })
            .then(editor => {
                editor['#ckeditor' + props.idname] = editor;
                editor.model.document.on('change', () => {
                    emit('update:modelValue', editor.getData());
                });
                editor.setData(value.value);
            })
            .catch(error => {
                console.error(error);
            });
    }, props.needTimeToLoad ? 500 : 0);
});
</script>

<template>
    <div class="text-sm">
        <slot />
    </div>
</template>

<style>
.ck-toolbar {
    border-radius: 8px !important;
}

.ck-toolbar-container {
    border: 1.5px solid #d1d5db !important;
    border-radius: 8px !important;
    margin-bottom: 20px !important;
    box-shadow: none !important;
}

.ck-dropdown__panel {
    border-radius: 8px !important;
}

.ck-dropdown__panel .ck-toolbar {
    border-radius: 8px !important;
}

.ck-content {
    border: 1.5px solid #d1d5db !important;
    border-radius: 8px !important;
    box-shadow: none !important;
    padding: 0px 0.75rem 0px 0.75rem !important;
}
</style>