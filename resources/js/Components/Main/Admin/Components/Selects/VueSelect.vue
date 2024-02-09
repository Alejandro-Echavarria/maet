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
    <vSelect class="mt-2 style-chooser text-sm" :appendToBody="append" >
    </vSelect>
</template>

<style>
.style-chooser {
    margin-top: 4px;
}

div.vs--single span.vs__selected {
    margin: 0px !important;
}
div.vs--open span.vs__selected {
    margin-top: 5px !important;
}

div.vs--single .vs__selected {
    padding: 0px 0.75rem 0px 0.75rem;
}

div.vs--single .vs__selected-options {
    padding: 0px;
}

.v-select.drop-up.vs--open .vs__dropdown-toggle {
    border-radius: 0 0 4px 4px;
    border-top-color: transparent;
    border-bottom-color: rgba(182, 0, 0, 0.26);
}

.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    color: #374151;
    text-transform: lowercase;
    font-variant: small-caps;
    border: 1.5px solid #d1d5db;
    border-radius: 8px 8px 8px 8px;
    margin-top: 0.5rem;
    padding-bottom: 2px;
    box-shadow: none;
}

.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle::focus {
    margin: 20px !important;
}

.vs__dropdown-menu {
    color: #374151;
    text-transform: lowercase;
    font-variant: small-caps;
    border: 1.5px solid #d1d5db;
    border-radius: 8px 8px 8px 8px;
    margin-top: 1px;
    box-shadow: none;
    font-size: 0.875rem;
    /* line-height: 1.6; */
}

.vs__dropdown-option--highlight {
    color: #fff;
    background-color: #5145cd;
}

.style-chooser .vs__search::placeholder {
    border: 0px solid #d1d5db;
}

.style-chooser input.vs__search {
    border: 0px;
    padding: 0px 0.75rem 0px 0.75rem;
    font-size: 0.875rem;
    line-height: 1.7rem;
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
    padding-top: 1px;
    cursor: pointer;
}
</style>