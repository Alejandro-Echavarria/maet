<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    idname: {
        type: String,
    },
    modelValue: {
        type: String,
        default: '',
    },
    idData: {
        type: [Number, String],
    },
    additionalPath: {
        type: String,
        default: ''
    },
    urlName: {
        type: String,
        default: null
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
                toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'bulletedList', 'numberedList', 'todoList', '|', 'alignment', 'indent', 'outdent', '|', props.urlName !== null ? 'uploadImage' : '|', 'blockQuote', 'insertTable', 'mediaEmbed', '|', 'code', 'codeBlock'],
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side',
                        'imageResize'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' }
                    ]
                },
                codeBlock: {
                    languages: [
                        { language: 'html', label: 'HTML' },
                        { language: 'css', label: 'CSS' },
                        { language: 'javascript', label: 'JavaScript' },
                        { language: 'php', label: 'PHP' },
                        { language: 'sql', label: 'SQL' },
                        { language: 'python', label: 'Python' },
                        { language: 'plaintext', label: 'Plain text' },
                        { language: 'xml', label: 'XML' },
                        { language: 'diff', label: 'Diff' },
                    ]
                },
                simpleUpload: {
                    uploadUrl: props.urlName !== null ? route(props.urlName, {
                        id: props.idData ? props.idData : null,
                        _token: usePage().props.csrf_token,
                        addPath: props.additionalPath,
                        'accept': 'application/json'
                    }) : '',
                },
                placeholder: 'Start typing. Select for more features',
                language: 'es',
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
