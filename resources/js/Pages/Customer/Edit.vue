<template>
    <AuthenticatedLayout>
		<template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit {{ customer.full_name }}</h2>
        </template>

        <Alert v-if="!!($page.props.flash.message)" :message="$page.props.flash.message"/>

		<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
			            <UserFormFields :form="form" isEdit />

			            <div class="flex items-center justify-end mt-4">
			                <PrimaryButton class="ml-4" >
			                    Update
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
import { ref, toRefs } from 'vue';
import Alert from '@/Components/Alert.vue';

const props = defineProps({
    customer: Object,
});

const { 
    customer: {
        value : {
            id,
            first_name,
            last_name,
            username,
            date_of_birth,
            email
        }
    },
} = toRefs(props);

const form = useForm({
    first_name,
    last_name,
    username,
    date_of_birth,
    email,
});

const submit = () => {
    form.date_of_birth = new Date(form.date_of_birth).toISOString().split('T')[0]
    form.post(route('customer.update', { id }), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
