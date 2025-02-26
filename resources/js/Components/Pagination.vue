<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Object,
    to: Number,
    from: Number,
    total: Number,
});
</script>

<template>
    <div
        v-if="Object.keys(links).length > 3"
        class="grid border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
    >
        <span class="col-span-3 flex items-center">
            Showing {{ from ?? '1' }}-{{ to ?? '15' }} of {{ total ?? 'many' }}
        </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <div class="col-span-4 mt-4 flex sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul
                    class="inline-flex items-center"
                    v-for="(link, key) in links"
                    :key="key"
                >
                    <li class="mb-1">
                        <span
                            v-if="link.url === null"
                            class="focus:shadow-outline-blue rounded-md px-3 py-1 focus:outline-none"
                            v-html="link.label"
                        >
                        </span>
                        <Link
                            preserve-state
                            preserve-scroll
                            v-else
                            class="focus:shadow-outline-blue rounded-md px-3 py-1 focus:outline-none"
                            :class="{
                                'focus:shadow-outline-blue rounded-md border border-r-0 border-blue-600 bg-blue-600 px-3 py-1 text-white transition-colors duration-150 focus:outline-none':
                                    link.active,
                            }"
                            :href="link.url"
                            v-html="link.label"
                        />
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
