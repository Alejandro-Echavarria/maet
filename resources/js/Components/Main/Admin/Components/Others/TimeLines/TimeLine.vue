<template>
    <div>
        <ol class="relative border-l border-gray-200 dark:border-indigo-700">
            <TransitionGroup name="list" tag="li">
                <slot name="list"/>
            </TransitionGroup>
        </ol>
    </div>
</template>

<style></style>
