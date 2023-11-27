<script setup>
// import SecondNav from "@/Components/Main/Admin/Layout/Nav/SecondNav.vue";
import Sidebar2 from "@/Components/Main/Admin/Layout/Nav/Sidebar2.vue";
</script>

<template>
    <div>
        <Sidebar2 />

        <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/5025H8K1wbI?si=jc-T7efm5o_wxYc6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->

        <main class="xs:px-0 lg:p-6 mx-4 lg:ml-64">
            <div class="2xl:max-w-[1500px] max-w-full mx-auto">
                <slot />
            </div>
        </main>
    </div>
</template>
