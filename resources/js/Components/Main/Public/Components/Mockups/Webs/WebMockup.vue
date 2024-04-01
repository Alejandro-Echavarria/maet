<template>
    <div>
        <div :class="['w-full justify-end']">
            <div class="rounded-xl overflow-hidden shadow-gray-500/20 shadow-lg w-full h-auto aspect-video">
                <div>
                    <div class="flex h-6 w-full items-center gap-5 px-3 bg-gray-800">
                        <div class="flex items-center gap-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-red-400"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-yellow-400"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-400"></div>
                        </div>
                        <div class="flex-1 pr-10 text-center text-[0.7rem] text-white leading-loose">
                            <p>
                                <slot v-if="$slots.link" name="link" />
                                <template v-else>
                                    demo.link.com
                                </template>
                            </p>
                        </div>
                    </div>

                    <slot name="image" />
                </div>
            </div>

            <slot name="stacks" />
        </div>
    </div>
</template>