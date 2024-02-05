<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="fixed top-1 z-50 w-full flex justify-center mb-8 px-2">
        <nav class="w-full z-50 mt-1 max-w-[90rem] 2xl:max-w-[100rem]">
            <div class="px-4 h-12 w-full backdrop-blur-md bg-white/60 dark:bg-[#333333]/60 bg-white border rounded-3xl border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full h-full flex items-center justify-between">
                    <div class="flex items-center justify-start h-full">
                        <!-- <button @click="toggleSidebarVisibility" class="mr-4 w-5 h-full text-gray-500 lg:hidden">
                            <div class="space-y-[0.375rem] h-auto">
                                <div
                                    :class="['w-5 h-[2px] rounded-lg bg-gray-600', isSidebarVisible ? '-translate-y-[2.5px] origin-left rotate-[44deg] transition duration-150' : 'rotate-0 transition-all duration-150 ease-linear']">
                                </div>
                                <div
                                    :class="['w-3 h-[2px] rounded-lg bg-gray-600', isSidebarVisible ? 'w-5 translate-y-[3.5px] translate-x-[1px] origin-left -rotate-[48deg] transition duration-150 ease-linear' : 'rotate-0 transition-all duration-150 ease-linear']">
                                </div>
                            </div>
                        </button> -->
                        <Link href="/" class="flex md:mr-24">
                            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                                MAET
                            </span>
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ml-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-7 w-7 rounded-full object-cover"
                                            :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                    </button>
                                </template>
    
                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>
    
                                    <DropdownLink :href="route('profile.show')" @click="handleResize">
                                        Profile
                                    </DropdownLink>
    
                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                        API Tokens
                                    </DropdownLink>
    
                                    <div class="border-t border-gray-200" />
    
                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>