<script setup>
import SecondNav from "@/Components/Main/Admin/Layout/Nav/SecondNav.vue";
</script>

<template>
    <div>
        <SecondNav :key="$page.url + 'nav'" >
            <slot />
        </SecondNav>
    </div>
</template>
