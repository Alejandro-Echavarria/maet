<template>
    <div>
        <div class="w-full md:max-w-sm bg-white border border-gray-200 rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h3 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
                        <slot name="title" />
                    </h3>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <slot name="preview" />
                </p>
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>