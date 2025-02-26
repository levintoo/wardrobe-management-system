<template>
    <Link
        :href="href"
        :method="method"
        :as="as"
        class="inline-flex items-center gap-2 rounded-md border border-transparent px-3 py-2 leading-none transition duration-150 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
    >
        <slot />
    </Link>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    href: {
        type: String,
    },
    method: {
        type: String,
    },
    as: {
        type: String,
    },
});
</script>
