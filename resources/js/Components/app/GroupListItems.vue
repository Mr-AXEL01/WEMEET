<script setup>

import GroupItem from "./GroupItem.vue";
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
            You are not joined to any groups
        </div>
        <div v-else>
            <GroupItem image="https://picsum.photos/100"
                       title="Laravel Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
            <GroupItem image="https://picsum.photos/100"
                       title="vue.js Developers"
                       description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."
            />
        </div>
    </div>
</template>

<style scoped>

</style>
