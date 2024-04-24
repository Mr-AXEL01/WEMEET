<script setup>

import {ref} from "vue";
import Input from "../Input.vue";

const postCreating = ref(false)

</script>

<template>
    <div class="p-4 bg-white rounded-lg border mb-3">
        <Input @click="postCreating = true"
                   class="py-3 px-2text-gray-400 border border-1 border-gray-200 rounded mb-3 w-full" placeholder="Click here to create new posts">
        </Input>
        <div v-if="postCreating" class="flex gap-2 justify-between ">
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold
                    text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600 relative">
                Attach Files
                <input type="file" class="absolute w-full left-0 top-0 right-0 bottom-0 opacity-0">
            </button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold
                    text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
