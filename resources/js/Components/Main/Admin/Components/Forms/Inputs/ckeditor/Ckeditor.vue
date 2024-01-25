<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-inline';
import { component as CKEditor } from '@ckeditor/ckeditor5-vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    idData: {
        type: Number,
    }
});

const emit = defineEmits(['update:modelValue']);
const value = ref(props.modelValue ? props.modelValue : '');

const editorConfig = ref({
    toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'codeBlock', 'insertTable', 'indent', 'outdent', 'alignment'],
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
        ]
    },
    ckfinder: {
        uploadUrl: route('admin.ckeditor.images.store', {
            id: props.idData ? props.idData : null,
            _token: usePage().props.csrf_token,
            'accept': 'application/json'
        }),
    },
    language: 'es',
});
</script>

<template>
    <div>
        <CKEditor :editor="ClassicEditor" v-model="value" :config="editorConfig"
            @input="$emit('update:modelValue', $event)" />
    </div>
</template>

<style>
.ck-toolbar {
    border-radius: 8px !important;
}

.ck-toolbar-container {
    border: 2px solid #e5e7eb !important;
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
    border: 2px solid #e5e7eb !important;
    border-radius: 8px !important;
    box-shadow: none !important;
}
</style>