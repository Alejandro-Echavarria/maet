<template>
    <div class="w-full">
        <div class="w-full bg-white border border-gray-200 rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="relative">
                <div class="overflow-auto">
                    <slot name="image" />
                </div>
                <div class="absolute top-0 right-0 py-4 px-5">
                    <slot name="deleteButton" />
                </div>
            </div>
            <div class="p-5">
                <a href="#">
                    <h3 class="font-bold tracking-tight text-gray-900 dark:text-white">
                        <slot name="title" />
                    </h3>
                </a>
                <div class="mb-3 h-auto text-gray-700 dark:text-gray-400 overflow-hidden">
                    <div class="space-y-2">
                        <slot name="preview" />
                    </div>
                </div>
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>