<script setup>
import { Link } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
</script>

<template>
    <ActionSection>
        <template #title>
            Personal Information
        </template>

        <template #description>
            Update your personal information and carreer.
        </template>

        <template #content>
            <div class="max-w-xl text-md font-medium text-gray-600">
                Complete or edit your personal information and carreer.
            </div>

            <div class="mt-2">
                <ul class="list-disc list-inside space-y-2 text-indigo-700 text-sm hover:*:text-indigo-500 *:transition *:duration-300">
                    <li>
                        <Link :href="route('admin.aboutme.index')">
                            About me
                        </Link>
                    </li>

                    <li>
                        <Link :href="route('admin.platforms.index')">
                            Platforms
                        </Link>
                    </li>

                    <li>
                        <Link :href="route('admin.resume.educations.index')">
                            Personal info
                        </Link>
                    </li>
                </ul>
            </div>
        </template>
    </ActionSection>
</template>