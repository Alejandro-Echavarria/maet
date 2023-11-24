<script setup>
import SecondNav from "@/Components/Main/Admin/Layout/Nav/SecondNav.vue";
</script>

<template>
    <div>
        <SecondNav />

        <div class="xs:px-0 sm:p-4 lg:p-6 mx-4 sm:ml-64">
            <div class="2xl:max-w-[1500px] max-w-full mx-auto">
                <slot />
            </div>
        </div>
    </div>
</template>
