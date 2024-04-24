<script setup>

import FollowingItem from "./FollowingItem.vue";
import TextInput from "../Input.vue";
import {ref} from "vue";

const searchKeyword = ref('');

</script>

<template>
    <TextInput :model-value="searchKeyword"
               placeholder="Type to search"
               class="w-[95%] mt-4 mx-auto p-2"
    />
    <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="false" class="text-gray-400 text-center p-3">
            You don't have any friends yet.
        </div>
        <div v-else>
            <FollowingItem image="https://picsum.photos/100"
                           title="John Doe"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="John Doe"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="John Doe"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="John Doe"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="John Doe"
            />
            <FollowingItem image="https://picsum.photos/100"
                           title="Elon Musk"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
