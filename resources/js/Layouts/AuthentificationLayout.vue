<template>
    <section class="h-full overflow-hidden flex flex-col p-3 bg-gray-100">
        <header class="flex justify-between">
            <Link href="/">
                <h1 class="font-bold text-2xl">WEMEET</h1>
            </Link>
            <Nav />
        </header>
    </section>

    <section class="flex-1 overflow-hidden">
            <slot/>
    </section>


</template>

<script setup>
import Nav from '../Components/Nav.vue';
import {Link} from "@inertiajs/vue3";



</script>
