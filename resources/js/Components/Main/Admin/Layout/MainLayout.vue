<script setup>
// import SecondNav from "@/Components/Main/Admin/Layout/Nav/SecondNav.vue";
import Navbar from "@/Components/Main/Admin/Layout/Nav/Navbar.vue";
</script>

<template>
    <div>
        <Navbar />

        <main class="xs:px-0 lg:p-6 mx-4 lg:ml-64">
            <div class="2xl:max-w-[1500px] max-w-full mx-auto">
                <slot />
            </div>
        </main>
    </div>
</template>
