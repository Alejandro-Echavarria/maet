<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <Link :href="route('aboutme.index')">
            <img loading="lazy" class="w-[350px] h-[450px] overflow-auto object-cover rounded-xl transition-all duration-300 cursor-pointer"
                src="/img/others/retrato.jpg" title="Manuel Echavarria" alt="Manuel Echavarria">
        </Link>
    </div>
</template>