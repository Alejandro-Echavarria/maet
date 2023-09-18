<script setup>
import { ref } from 'vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { component as CKEditor } from '@ckeditor/ckeditor5-vue';

const props = defineProps({
    modelValue: String,
});

const emit = defineEmits(['update:modelValue']);
const value = ref(props.modelValue);

const editorConfig = ref({
    toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'codeBlock', 'insertTable', 'indent', 'outdent', 'alignment'],
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
        ]
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
    border-top: 2px solid #e5e7eb !important;
    border-right: 2px solid #e5e7eb !important;
    border-left: 2px solid #e5e7eb !important;
    border-radius: 12px 12px 0px 0px !important;
}

.ck-dropdown__panel {
    border-radius: 12px !important;
    /* overflow: hidden !important; */
}

.ck-dropdown__panel .ck-toolbar {
    border-radius: 12px !important;
}

.ck-content {
    border: 2px solid #e5e7eb !important;
    border-radius: 0px 0px 12px 12px !important;
    box-shadow: none !important;
}
</style>