<template>
    <Head title="login" />
    <main class="grid place-items-center w-full bg-gray-100 min-h-screen">
        <section class="p-10 rounded w-[400px] bg-white mx-auto border">
            <h1 class="text-3xl mb-6">
                Login
            </h1>
            <form @submit.prevent="submit">
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
                    <button type="submit" class="bg-blue-400 text-white rounded-lg py-2 px-4 hover:bg-blue-500">
                        Log In
                    </button>
                </div>
            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                    create new account
                </a>
            </p>
        </section>
    </main>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";

let form = useForm({
    email: '',
    password: ''
});


let submit = () => {
    form.post('/login')
}

</script>
