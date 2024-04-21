<template>

    <div>
        <pre>
            {{user}}
        </pre>
    </div>

</template>

<script setup>


import {usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user;

</script>
