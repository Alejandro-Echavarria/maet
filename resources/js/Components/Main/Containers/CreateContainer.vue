<template>
    <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-3">
        <div class="w-full md:w-1/2">
            <slot name="search" />
        </div>
        <div
            class="w-full md:w-auto ">
            <slot name="createButton" />
        </div>
    </div>
</template>