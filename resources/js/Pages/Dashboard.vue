<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    stats: Object,
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900">Categories</div>
                    <div class="mt-3 text-gray-900 text-2xl font-semibold">{{ stats.categories }}</div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900">Clothing Items</div>
                    <div class="mt-3 text-gray-900 text-2xl font-semibold">{{  stats.clothing }}</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
