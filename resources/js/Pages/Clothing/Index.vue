<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, watch } from 'vue';
import { debounce, omitBy } from 'lodash';
import TableHeadItem from '@/Components/TableHeadItem.vue';
import TableBody from '@/Components/TableBody.vue';
import TableBodyItem from '@/Components/TableBodyItem.vue';
import TableHead from '@/Components/TableHead.vue';
import TableData from '@/Components/TableData.vue';
import Pagination from '@/Components/Pagination.vue';
import Table from '@/Components/Table.vue';
import IconButton from '@/Components/IconButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { toast } from 'vue-sonner';
import TrashIcon from '@/Components/icons/TrashIcon.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SearchIcon from "@/Components/icons/SearchIcon.vue";
import IconLink from "@/Components/IconLink.vue";
import EditIcon from "@/Components/icons/EditIcon.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    clothing: {
        type: Object,
    },
    filters: {
        type: Object,
    },
    categories: {
        type: Object,
    }
});

const params = ref({
    search: props.filters.search ?? '',
    field: props.filters.field ?? '',
    direction: props.filters.direction ?? '',
    category: props.filters.category ?? '',
});

const sort = (field) => {
    params.value.field = field;
    params.value.direction = params.value.direction === 'asc' ? 'desc' : 'asc';
};

watch(
    params.value,
    debounce((params) => {
        router.get(
            '/clothing',
            { ...omitBy(params, (v) => v === '') },
            { preserveScroll: true, replace: true, preserveState: true },
        );
    }, 150),
);

const resetFilters = () => {
    params.value.search = '';
    params.value.field = '';
    params.value.direction = '';
    params.value.category = '';
};

const handleDelete = (id) => {
    if (
        !confirm(
            'Are you sure you want to continue, this is a destructive action',
        )
    )
        return;
    router.delete('/clothing/' + id, {
        preserveScroll: true,
        onError: () => {
            toast('Something went wrong, failed to remove category');
        },
        onSuccess: () => {
            toast('Item removed successfully');
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="clothing" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                clothing
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl rounded-lg overflow-clip shadow-lg">
                <div class="w-full rounded-t bg-white p-5">
                    <div
                        class="flex flex-col gap-4 md:flex-row md:justify-between"
                    >
                        <div class="space-y-1 flex flex-col md:flex-row gap-2">
                            <div class="space-y-1 relative">
                                <div class="absolute inset-y-0 left-3 flex items-center">
                                    <SearchIcon class="w-4 h-4 text-gray-500" />
                                </div>
                                <TextInput
                                    placeholder="search here..."
                                    id="search"
                                    v-model="params.search"
                                    type="text"
                                    class="w-full px-3 py-2 text-sm pl-9 rounded-lg"
                                />
                            </div>

                            <div>
                                <SelectInput
                                    placeholder="select category"
                                    id="name"
                                    class="w-full min-w-48 px-3 py-2 text-sm rounded-lg"
                                    v-model="params.category"
                                    autofocus
                                    autocomplete="category_id"
                                >
                                    <option selected value="">
                                        select category
                                    </option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </SelectInput>
                            </div>
                        </div>

                        <div class="flex items-end gap-3 space-y-1">
                            <SecondaryButton
                                @click="resetFilters()"
                                class="rounded-md px-4 py-2 text-sm font-medium"
                            >
                                Reset Filters
                            </SecondaryButton>

                            <Link :href="route('clothing.create')">
                                <PrimaryButton
                                    class="rounded-md px-4 py-2 text-sm font-medium"
                                >
                                    New Clothing
                                </PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>

                <Table>
                    <template #thead>
                        <TableHead>
                            <TableHeadItem field="id" />
                            <TableHeadItem
                                class="cursor-pointer"
                                field="name"
                                :params="params"
                                @click="sort('name')"
                            />
                            <TableHeadItem field="Category" />
                            <TableHeadItem
                                class="cursor-pointer"
                                field="created_at"
                                :params="params"
                                @click="sort('created_at')"
                            />
                            <TableHeadItem
                                field="action"
                                colspan="3"
                                class="text-center"
                                >action</TableHeadItem
                            >
                        </TableHead>
                    </template>
                    <template #tbody>
                        <TableBody
                            class="whitespace-nowrap"
                            v-if="clothing.data.length > 0"
                        >
                            <TableBodyItem
                                v-for="clothingitem in clothing.data"
                                :key="clothingitem.id"
                            >
                                <TableData>{{ clothingitem.id }}</TableData>
                                <TableData :title="clothingitem.description">
                                    <img class="h-20 w-auto min-w-28 object-cover rounded-lg" v-if="clothingitem.image_path" :src="clothingitem.image_path" :alt="`${clothingitem.name} image`" />

                                    <span v-else>-</span>
                                </TableData>
                                <TableData :title="clothingitem.description">{{
                                        clothingitem.name ?? '-'
                                }}</TableData>
                                <TableData>{{
                                        clothingitem.category ?? '-'
                                }}</TableData>
                                <TableData>{{
                                        clothingitem.created_at ?? '-'
                                    }}</TableData>
                                <TableData>
                                    <IconButton
                                        @click="handleDelete(clothingitem.id)"
                                        class="text-red-500 focus:ring-red-300"
                                    >
                                        Delete
                                        <TrashIcon class="size-4" />
                                    </IconButton>

                                    <IconLink
                                        :href="route('clothing.edit', clothingitem.id)"
                                        class="text-gray-500 focus:ring-gray-300"
                                    >
                                        Edit
                                        <EditIcon class="size-4" />
                                    </IconLink>
                                </TableData>
                            </TableBodyItem>
                        </TableBody>
                        <TableBodyItem v-else class="bg-white">
                            <TableData
                                colspan="10"
                                class="text-center text-gray-500"
                            >
                                There is nothing to show here
                            </TableData>
                        </TableBodyItem>
                    </template>
                    <template #pagination>
                        <Pagination
                            v-if="clothing.links"
                            :from="clothing.from"
                            :to="clothing.to"
                            :total="clothing.total"
                            :links="clothing.links"
                        />
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
