<template>
    <teleport to="body">
        <TransitionRoot appear :show="show" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black/25"/>
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded-lg bg-white text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="flex items-center justify-between py-3 px-4 font-medium leading-6 bg-gray-100 text-gray-900"
                                >
                                    Update Post
                                    <button @click="show = false" class="w-8 h-8 rounded-full hover:bg-black/5 transition  flex items-center justify-center">
                                        <XMarkIcon class="w-4 h-4" />
                                    </button>
                                </DialogTitle>
                                <div class="p-4">
                                    <PostUserProfile :post="post" :show-time="false" class="mb-4"/>
                                    <TextareaInput v-model="post.body" class="mb-3 py-1 px-2 w-full" />
                                </div>

                                <div class="py-2 px-3">
                                    <button
                                        type="button"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold
                    text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600 w-full"
                                        @click="closeModal"
                                    >
                                        submit
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </teleport>
</template>

<script setup>
import {computed, ref} from 'vue';
import { XMarkIcon } from "@heroicons/vue/24/solid";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import TextareaInput from "../TextareaInput.vue";
import PostUserProfile from "./PostUserProfile.vue";


const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    modelValue: Boolean,
})


const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})


const emit = defineEmits(['update:modelValue'])

function closeModal() {
    show.value = false
    emit('update:modelValue', false)
}

</script>
