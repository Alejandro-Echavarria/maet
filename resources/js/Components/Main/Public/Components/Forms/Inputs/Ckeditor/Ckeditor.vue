<script setup>
import { ref, onMounted, defineAsyncComponent } from 'vue';

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

const SimpleTextArea = defineAsyncComponent(() => import('@/Components/Main/Admin/Components/Forms/Inputs/TextArea/SimpleTextArea.vue'));

const render = ref(false);
const emit = defineEmits(['update:modelValue']);
const value = ref(props.modelValue ? props.modelValue : '');

onMounted(() => {
    setTimeout(() => {
        try {
            BalloonEditor
                .create(document.querySelector('#ckeditor' + props.idname), {
                    toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'bulletedList', 'numberedList', '|', 'alignment', 'indent', 'outdent', '|', 'insertTable'],
                    placeholder: 'What\'s on your mind?. Select for more features',
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
                    render.value = true;
                });
        } catch (error) {
            render.value = true;
        }
    }, props.needTimeToLoad ? 500 : 0);
});
</script>

<template>
    <div id="ckeditorContainer">
        <SimpleTextArea v-if="render" :value="value" @input="$emit('update:modelValue', $event.target.value)" placeholder="What's on your mind?" />
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