<template>
    <AuthenticatedLayout>
		<template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Customer</h2>
        </template>

		<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
			            <UserFormFields :form="form" />

			            <div class="flex items-center justify-end mt-4">
			                <PrimaryButton class="ml-4" >
			                    Add
			                </PrimaryButton>
			            </div>
			        </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserFormFields from '@/Components/UserFormFields.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    first_name: '',
    last_name: '',
    username: '',
    date_of_birth: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.date_of_birth = new Date(form.date_of_birth).toISOString().split('T')[0]
    form.post(route('customer.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
