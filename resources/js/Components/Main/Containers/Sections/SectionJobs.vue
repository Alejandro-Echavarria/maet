<template>
    <div class="w-full">
        <div class="w-full bg-white border border-gray-200 rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h3 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
                        <slot name="title" />
                    </h3>
                </a>
                <div class="mb-3 h-auto text-gray-700 dark:text-gray-400 overflow-hidden">
                    <div class="h-[4.5rem]">
                        <slot name="preview" />
                    </div>
                </div>
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>