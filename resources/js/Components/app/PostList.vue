<script setup>

import PostItem from "./PostItem.vue";

defineProps({
    posts: Array,
});

</script>

<template>
    <div class="overflow-auto lg:h-[77vh]">
        <PostItem v-for="post of posts" :key="post.id" :post="post" />
    </div>
</template>

<style scoped>

</style>
