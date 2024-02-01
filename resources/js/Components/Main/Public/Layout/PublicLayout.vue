<script setup>
import Navbar from "@/Components/Main/Public/Layout/Nav/Navbar.vue";
</script>

<template>
    <div>
        <Navbar />
        <main class="xs:px-0 mx-4">
            <div class="max-w-5xl mx-auto">
                <slot />
            </div>
        </main>
    </div>
</template>