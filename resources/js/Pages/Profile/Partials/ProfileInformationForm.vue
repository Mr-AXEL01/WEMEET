<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 ">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-600 ">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <div>
                <Label for="name" value="Name"/>

                <Input
                    id="name"
                    type="text"
                    class="mt-1 block w-full border"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />
                <div v-show="message">
                    <p class="text-sm text-red-600 ">
                        {{ message }}
                    </p>
                </div>
                <Error class="mt-2" :message="form.errors.name"/>
            </div>
            <div>
                <Label for="username" value="Username"/>

                <Input
                    id="username"
                    type="text"
                    class="mt-1 block w-full border"
                    v-model="form.username"
                    required
                    autocomplete="username"
                />

                <Error class="mt-2" :message="form.errors.username"/>
            </div>

            <div>
                <Label for="email" value="Email"/>

                <Input
                    id="email"
                    type="email"
                    class="mt-1 block w-full border"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <Error class="mt-2" :message="form.errors.email"/>
            </div>

            <div class="flex items-center gap-4">
                <AlphaButton :disabled="form.processing">Save</AlphaButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>

            </div>
        </form>
    </section>
</template>

<script setup>
import Error from '../../../Components/Error.vue';
import Label from '../../../Components/Label.vue';
import Input from "../../../Components/Input.vue";
import { usePage, useForm } from '@inertiajs/vue3';
import AlphaButton from "../../../Components/AlphaButton.vue";

const { props } = usePage();
const form = useForm({
    name: props.auth.user.name,
    username: props.auth.user.username,
    email: props.auth.user.email,
});

const submitForm = () => {
    form.patch(route('profile.update'));
};
</script>
