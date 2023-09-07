<script setup>
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
</script>

<template>
    <vSelect class="mt-3 style-chooser">
    </vSelect>
</template>

<style>
.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    color: #747474;
    text-transform: lowercase;
    font-variant: small-caps;
    border: 2px solid #e5e7eb;
    border-radius: 0px 0px 8px 8px;
    margin-top: -4px;
    box-shadow: none;
}

.style-chooser .vs__search::placeholder {
    border: 0px solid #e5e7eb;
}

.style-chooser .vs__search input {
    border: 0px;
    padding: 0px;
}

.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle {
    border-radius: 8px;
}

.style-chooser .vs__search {
    padding-bottom: 3px;
}


.style-chooser .vs__dropdown-menu,
.style-chooser .vs__dropdown-max-height {
    max-height: 130px;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
    fill: #5145cd;
}
</style>