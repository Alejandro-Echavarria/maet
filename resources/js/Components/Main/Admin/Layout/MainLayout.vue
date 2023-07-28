<script setup>
import SideNave from "@/Components/Main/Admin/Layout/Nav/SideNav.vue";
</script>

<template>
    <div>
        <SideNave />
        <!-- Content -->
        <div class="!pl-0 xl:!pl-60 pb-4 sm:px-0 lg:px-6 mx-4">
            <slot />
        </div>
    </div>
</template>
