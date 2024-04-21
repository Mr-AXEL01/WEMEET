<template>
    <nav class="flex">
        <ul v-if="!username" class="flex space-x-6">
            <li>
                <Link href="/register" class="text-black hover:underline">
                    Sign-Up
                </Link>
            </li>
            <li>
                <Link href="/login" class="text-black hover:underline">
                    Sign-in
                </Link>
            </li>
        </ul>
        <ul v-else class="flex space-x-6">
            <li>
                <Link :href="'/u/' + username" class="text-black hover:underline">
                    {{username}}
                </Link>
            </li>
            <li>
                <Link method="post" href="/logout" as="button" class="text-black hover:underline">
                    Logout
                </Link>
            </li>
        </ul>
    </nav>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
    components:{ Link },
    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
};
</script>
