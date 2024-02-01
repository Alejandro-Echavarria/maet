<script setup>
import Nav from "@/Components/Main/Public/Layout/Nav/Nav.vue";
</script>

<template>
    <div>
        <Nav />
        <main class="xs:px-0 mx-4">
            <div class="max-w-5xl mx-auto">
                <slot />
            </div>
        </main>
    </div>
</template>