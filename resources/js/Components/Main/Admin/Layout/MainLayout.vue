<script setup>
import SecondNav from "@/Components/Main/Admin/Layout/Nav/SecondNav.vue";
</script>

<template>
    <div>
        <SecondNav :key="$page.url + 'nav'" />

        <div class="xs:px-0 sm:p-4 lg:px-6 mx-4 sm:ml-64">
            <div class="mt-14">
                <slot />
            </div>
        </div>
    </div>
</template>
