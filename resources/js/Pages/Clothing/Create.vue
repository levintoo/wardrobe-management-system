<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {toast} from "vue-sonner";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

defineProps({
    categories: {
        type: Object,
    }
})

const form = useForm({
    name: "",
    description: "",
    category_id: "",
    image: null,
});

const handleSubmit = () => {
    form.post('/clothing/create',{
        preserveScroll: true,
        onError: () => {
            toast('something went wrong')
        },
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Clothing Item" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Clothing Item
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl rounded-lg overflow-clip shadow-lg bg-white">
                <div class="space-y-6 mb-6">
                    <div class="p-4 sm:p-6 bg-white sm:rounded-md shadow-sm">
                        <section>

                            <form @submit.prevent="handleSubmit()" class="space-y-6">
                                <div>
                                    <InputLabel for="name" value="Name" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="category_id" value="Category_id" />

                                    <SelectInput
                                        id="name"
                                        class="mt-1 block w-full"
                                        v-model="form.category_id"
                                        autocomplete="category_id"
                                    >
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </SelectInput>

                                    <InputError class="mt-2" :message="form.errors.category_id" />
                                </div>

                                <div>
                                    <InputLabel for="description" value="Description" />

                                    <TextareaInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.description"
                                        autocomplete="description"
                                    />

                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>

                                <div>
                                    <InputLabel for="image" value="Image" />

                                    <input
                                        id="name"
                                        type="file"
                                        class="mt-1 block w-full"
                                        autocomplete="image"
                                        @input="form.image = $event.target.files[0]"
                                    />

                                    <InputError class="mt-2" :message="form.errors.image" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing">Submit</PrimaryButton>

                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                    </Transition>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
