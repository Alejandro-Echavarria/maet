<script setup>
import Navbar from "@/Components/Main/Public/Layout/Nav/Navbar.vue";
import MainFooter from "@/Components/Main/Public/Footers/MainFooter.vue";
</script>

<template>
    <div>
        <Navbar />
        <main class="xs:mx-0 mx-4 mt-20">
            <div class="max-w-5xl mx-auto">
                <slot />
            </div>
        </main>
        <MainFooter />
    </div>
</template>