<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';

const props = defineProps({
    data: {
        type: Object,
        required: true
    },
});

const value = ref(props.data);

onMounted(() => {
    const datedatepickerId2pickerEl = document.getElementById('dateRangePickerId');
    new DateRangePicker(datedatepickerId2pickerEl, {
        autohide: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });
});

onUnmounted(() => {
    const datedatepickerId2pickerEl = document.querySelectorAll('.datepicker');
    datedatepickerId2pickerEl.forEach((datepicker) => {
        datepicker.remove();
    });
});
</script>

<template>
    <div id="dateRangePickerId" date-rangepicker class="flex items-center w-full">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>

            <TextInput id="start" name="start" type="text" class="pl-7" :value="value.start_date"
                placeholder="Select date start" />
        </div>
        <span class="mx-4 text-gray-500">to</span>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>

            <TextInput id="end" name="end" type="text" class="pl-7" :value="value.end_date"
                placeholder="Select date end" />
        </div>
    </div>
</template>