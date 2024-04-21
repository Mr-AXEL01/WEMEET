<template>
    <Head title="Register" />
    <main class="grid place-items-center w-full bg-gray-100 min-h-screen">
        <section class="p-10 rounded w-[400px] bg-white mx-auto border">
            <h1 class="text-3xl mb-6">
                Sign-Up
            </h1>
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Name
                    </label>
                    <input v-model="form.name" type="text" class="border rounded p-2 w-full" name="name" id="name" required>
                    <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1">

                    </div>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Email
                    </label>
                    <input v-model="form.email" type="email" class="border rounded p-2 w-full" name="email" id="email" required>
                    <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1">

                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Password
                    </label>
                    <input
                        v-model="form.password"
                        class="border rounded-lg p-2 w-full"
                        type="password"
                        name="password"
                        id="password"
                        required
                    >
                    <div v-if="form.errors.password"
                         v-text="form.errors.password"
                         class="text-red-500 text-xs mt-1">

                    </div>
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Password Confirmation
                    </label>
                    <input
                        v-model="form.password_confirmation"
                        class="border rounded-lg p-2 w-full"
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                    >
                    <div v-if="form.errors.password_confirmation"
                         v-text="form.errors.password_confirmation"
                         class="text-red-500 text-xs mt-1">

                    </div>
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded-lg py-2 px-4 hover:bg-blue-500">
                        Sign-Up
                    </button>
                </div>
            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Already have an account?
                <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                    signup with an exist account
                </a>
            </p>
        </section>
    </main>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";

let form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});


let submit = () => {
    form.post('/register')
}

</script>
