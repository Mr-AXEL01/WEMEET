<template>
    <section class="h-full overflow-hidden flex flex-col p-3 bg-gray-100">
        <header class="flex justify-between">
            <h1 class="font-bold text-2xl">My app</h1>
            <Nav />
        </header>
    </section>

    <section class="flex-1 overflow-hidden">
            <slot/>
    </section>


</template>

<script>
import Nav from '../Components/Nav.vue';
export default {
    components: { Nav },
};
</script>
