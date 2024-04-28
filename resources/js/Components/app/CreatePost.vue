<script setup>

import {ref} from "vue";
import PostModel from "./PostModal.vue";
import {usePage} from "@inertiajs/vue3";


const authUser = usePage().props.auth.user;

const showModal = ref(false);
const newPost = ref({
    id: null,
    body: '',
    user: authUser
})

function showCreatingPostModal() {
    showModal.value = true
}

</script>

<template>
    <div class="p-4 bg-white flex items-center justify-between gap-1 rounded-lg border mb-3">
        <img :src="authUser.avatar_url || '/img/default_avatar.jpg'"
             class="w-[42px] h-[42px] object-cover rounded-full border border-2 transition-all
                     hover:border-blue-500"
        />
        <div @click="showCreatingPostModal"
             class="py-2 px-3 border-2 border-gray-200 text-gray-500 rounded-full w-full"
             rows="1">
            Click here to create new post
        </div>
        <!--        <div class="flex gap-2 justify-between ">-->
        <!--            <button type="button"-->
        <!--                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold-->
        <!--                    text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2-->
        <!--                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600 relative">-->
        <!--                Attach Files-->
        <!--                <input type="file" class="absolute w-full left-0 top-0 right-0 bottom-0 opacity-0">-->
        <!--            </button>-->
        <!--            <button @click="submit" type="submit"-->
        <!--                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold-->
        <!--                    text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2-->
        <!--                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600">-->
        <!--                Save-->
        <!--            </button>-->
        <!--        </div>-->

        <PostModel :post="newPost" v-model="showModal"/>
    </div>
</template>
