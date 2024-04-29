<template>
    <section class="h-full overflow-hidden flex flex-col p-3 bg-gray-100">
        <header class="flex items-center justify-between w-[95%] h-10 mx-auto">
            <Link href="/">
                <div class=" w-24 flex items-center ">
                    <WemeetLogo  class=" flex-none" />
                    <h1 class="font-bold text-xl text-sky-900 -ml-5">EMEET</h1>
                </div>
            </Link>
            <nav class="flex">
                <ul v-if="!authUser" class="flex space-x-6">
                    <li class="flex items-center space-x-1">
                        <UserPlusIcon class="w-5 h-5"/>
                        <Link href="/register" class="text-black hover:underline">
                            Register
                        </Link>
                    </li>
                    <li class="flex items-center space-x-1">
                        <ArrowRightEndOnRectangleIcon class="w-5 h-5"/>
                        <Link href="/login" class="text-black hover:underline">
                            Login
                        </Link>
                    </li>
                </ul>
                <ul v-else class="flex space-x-6">
                    <li class="flex items-center space-x-1">
                        <UserCircleIcon class="w-5 h-5"/>
                        <Link :href="'/u/' + authUser.username" class="text-black hover:underline">
                            {{authUser.name}}
                        </Link>
                    </li>
                    <li class="flex items-center space-x-1">
                        <ArrowRightEndOnRectangleIcon class="w-5 h-5 rotate-180"/>
                        <Link method="post" href="/logout" as="button" class="text-black hover:underline">
                            Logout
                        </Link>
                    </li>
                </ul>
            </nav>
        </header>
    </section>

    <section class="flex-1 overflow-hidden">
            <slot/>
    </section>


</template>

<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {UserPlusIcon , UserCircleIcon , ArrowRightEndOnRectangleIcon} from "@heroicons/vue/24/solid";
import WemeetLogo from "../Components/WemeetLogo.vue";

const authUser = usePage().props.auth.user;

defineProps({
    user: {
        type: Object
    }
})
</script>
