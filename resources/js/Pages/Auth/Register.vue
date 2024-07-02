<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="first_name" value="Name" />

                <TextInput
                    id="first_name"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.first_name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="last_name" value="Name" />

                <TextInput
                    id="last_name"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.last_name"
                    required
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.last_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="block w-full mt-1"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="block w-full mt-1"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="block w-full mt-1"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="my-3">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Continue
                </PrimaryButton>
            </div>

            <div class="pt-4 text-xs">
                By signing-in you agree to Amazon's Conditions of use & Sale.
                Please see our Privacy Notice, Our Cookies Notice and our Interest-Based Ads Notice.
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="text-sm text-blue-700 rounded-md hover:underline hover:text-re-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400"
                >
                    Sign in?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
