<script setup>
import Nav from "@/Components/Main/Admin/Layout/Nav/Nav.vue";
</script>

<template>
    <div>
        <Nav v-inertia-ignore />

        <!-- Content -->
        <div class="!pl-0 xl:!pl-60 pb-4 sm:px-0 lg:px-6 mx-4">
            <slot />
        </div>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/KD62P6N61SI" title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>

        <div class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
                <div class="rounded-full bg-slate-700 h-10 w-10"></div>
                <div class="flex-1 space-y-6 py-1">
                    <div class="h-2 bg-slate-700 rounded"></div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                            <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                        </div>
                        <div class="h-2 bg-slate-700 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
