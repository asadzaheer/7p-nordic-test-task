<template>
	<div class="p-4 sm:p-6 lg:p-8">
	  <div class="sm:flex sm:items-center">
		<div class="sm:flex-auto">
		  <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">Customers</h1>
		  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">A list of all the customers.</p>
		</div>
		<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
			<Link
                :href="route('customer.add')"
            >
				<PrimaryButton type="">
	                   Add Customer
		        </PrimaryButton>
            </Link>
		</div>
	  </div>
	  <div class="mt-8 flow-root">
		<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
		  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
			<table class="min-w-full divide-y divide-gray-300">
			  <thead>
				<tr>
				  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-0">Name</th>
				  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Username</th>
				  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Email</th>
				  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Date Of Birth</th>
				  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
					<span class="sr-only">Edit</span>
				  </th>
				</tr>
			  </thead>
			  <tbody class="divide-y divide-gray-200">
				<tr v-for="customer in customers" :key="customer.id">
				  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100 sm:pl-0">{{ customer.full_name }}</td>
				  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">{{ customer.username }}</td>
				  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">{{ customer.email }}</td>
				  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">{{ customer.date_of_birth }}</td>
				  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
					<Link
						class="text-indigo-600 hover:text-indigo-900 dark:text-gray-300 dark:hover:text-gray-100"
	                    :href="route('customer.edit', {id: customer.id})"
	                >
						Edit<span class="sr-only">, {{ customer.full_name }}</span>
	                </Link>

					<span
						class="text-indigo-600 hover:text-indigo-900 dark:text-gray-300 dark:hover:text-gray-100 ml-2 cursor-pointer"
	                    @click="handleDelete(customer)"
	                >
						Delete<span class="sr-only">, {{ customer.full_name }}</span>
	                </span>
				  </td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
	<Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete {{ selectCustomer.full_name }} customer?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once account is deleted, all of its resources and data will be permanently deleted.
            </p>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                <DangerButton
                    class="ml-3"
                    @click="deleteCustomer(selectCustomer.id)"
                >
                    Delete Customer
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>
  
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

defineProps({
    customers: Array
});

const confirmingUserDeletion = ref(false);
const selectCustomer = ref(null);
const form = useForm({
    id: null,
});

const handleDelete = (customer) => {
	selectCustomer.value = customer;
	confirmingUserDeletion.value = true;
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
};

const deleteCustomer = (id) => {
	form.id = id;
	form.delete(route('customer.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: (error) => alert(error),
        onFinish: () => form.reset(),
    });
    // route('customer.destroy', { id });
	// closeModal();
};
</script>