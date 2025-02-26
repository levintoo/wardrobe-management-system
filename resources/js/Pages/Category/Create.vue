<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {toast} from "vue-sonner";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: "",
});

const handleSubmit = () => {
    form.post('/category/create',{
        preserveScroll: true,
        onError: () => {
            toast('something went wrong')
        },
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Category" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Category
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
