<template>
    <th class="whitespace-nowrap px-4 py-3">
        <div class="flex justify-between">
            <span>
                {{ field }}
            </span>
            <span v-if="params" class="ml-2">
                <ChevronIcon
                    v-if="
                        params &&
                        params.field === sort_field &&
                        params.direction === 'desc'
                    "
                />
                <ChevronIcon
                    v-if="
                        params &&
                        params.field === sort_field &&
                        params.direction === 'asc'
                    "
                    class="h-4 w-3 rotate-180"
                />
            </span>
        </div>
    </th>
</template>
<script setup>
import { computed } from 'vue';
import ChevronIcon from '@/Components/icons/ChevronIcon.vue';

const props = defineProps({
    params: Object,
    field: {
        type: String,
        required: true,
    },
    sort: {
        type: String,
    },
});
const sort_field = computed(() => props.sort ?? props.field);
</script>
