<script setup>

import PostItem from "./PostItem.vue";
import PostModel from "./PostModal.vue";
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import AttachmentPreviewModal from "./AttachmentPreviewModal.vue";

defineProps({
    posts: Array,
});

const authUser = usePage().props.auth.user;
const showEditModal = ref(false)
const showAttachmentsModal = ref(false)
const editPost =ref({})
const previewAttachmentsPost = ref({})

function openEditModal(post){
    editPost.value = post;
    showEditModal.value = true;
}

function openAttachmentPreviewModal(post, index) {
    // debugger
    previewAttachmentsPost.value = {
        post,
        index
    }
    showAttachmentsModal.value = true;
}

function onModalHide() {
    editPost.value = {
        id: null,
        body: '',
        user: authUser
    }
}

</script>

<template>
    <div class="overflow-auto lg:h-[77vh]">
        <PostItem v-for="post of posts" :key="post.id" :post="post"
                  @editClick="openEditModal"
                  @attachmentClick="openAttachmentPreviewModal"
        />
        <PostModel :post="editPost" v-model="showEditModal" @hide="onModalHide" />
        <AttachmentPreviewModal :attachments="previewAttachmentsPost.post?.attachments || []"
                                v-model:index="previewAttachmentsPost.index"
                                v-model="showAttachmentsModal"
        />
    </div>

</template>

<style scoped>

</style>
