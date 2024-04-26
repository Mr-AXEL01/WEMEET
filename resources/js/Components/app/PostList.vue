<script setup>

import PostItem from "./PostItem.vue";
import PostModel from "./PostModel.vue";
import {ref} from "vue";

defineProps({
    posts: Array,
});

const showEditModal = ref(false)
const editPost =ref({})

function openEditModal(post){
    editPost.value = post;
    showEditModal.value = true;
}

</script>

<template>
    <div class="overflow-auto lg:h-[77vh]">
        <PostItem v-for="post of posts" :key="post.id" :post="post" @editClick="openEditModal" />
        <PostModel :post="editPost" v-model="showEditModal" />
    </div>

</template>

<style scoped>

</style>
