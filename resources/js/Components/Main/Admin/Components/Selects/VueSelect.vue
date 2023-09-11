<script setup>
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

defineProps({
    append: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <vSelect class="mt-3 style-chooser" :appendToBody="append">
    </vSelect>
</template>

<style>
.v-select.drop-up.vs--open .vs__dropdown-toggle {
    border-radius: 0 0 4px 4px;
    border-top-color: transparent;
    border-bottom-color: rgba(182, 0, 0, 0.26);
}

.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    color: #747474;
    text-transform: lowercase;
    font-variant: small-caps;
    border: 2px solid #e5e7eb;
    border-radius: 8px 8px 8px 8px;
    margin-top: 1.5px;
    box-shadow: none;
}

.vs__dropdown-menu {
    color: #747474;
    text-transform: lowercase;
    font-variant: small-caps;
    border: 2px solid #e5e7eb;
    border-radius: 8px 8px 8px 8px;
    margin-top: 1px;
    box-shadow: none;
}

.style-chooser .vs__search::placeholder {
    border: 0px solid #e5e7eb;
}

.style-chooser input.vs__search {
    border: 0px;
    padding: 0px;
    margin: 4px;
}

.style-chooser input.vs__search:focus {
    outline: none !important;
    outline-width: 0 !important;
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
}

.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle {
    border-radius: 8px;
}

.style-chooser .vs__search {
    padding-bottom: 3px;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
    fill: #5145cd;
}
</style>