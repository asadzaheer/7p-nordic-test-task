<template>
<div class="grid grid-cols-3 gap-2">
    <div>
        <InputLabel for="first_name" value="First Name" />

        <TextInput
            id="first_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.first_name"
            required
            autofocus
            autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.first_name" />
    </div>

    <div>
        <InputLabel for="last_name" value="Last Name" />

        <TextInput
            id="last_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.last_name"
            required
            autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.last_name" />
    </div>

    <div>
        <InputLabel for="username" value="Username" />

        <TextInput
            id="username"
            type="text"
            class="mt-1 block w-full"
            v-model="form.username"
            required
            autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.username" />
    </div>

    <div>
        <InputLabel for="date_of_birth" value="Date of birth" class="mb-1" />

        <VueDatePicker
            v-model="form.date_of_birth"
            :enable-time-picker="false"
            format="dd/MM/yyyy"
        />

        <InputError class="mt-2" :message="form.errors.date_of_birth" />
    </div>

    <div>
        <InputLabel for="email" value="Email" />

        <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
    </div>

    <div v-if="!isEdit" class="col-span-2">
        <InputLabel for="password" value="Password" />

        <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
    </div>

    <div v-if="!isEdit" class="col-span-2">
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
    </div>
</div>
</template>
<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    form: Object,
    isEdit: Boolean
});
</script>

<style>
.dp__input {
    @apply border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm;
}
</style>