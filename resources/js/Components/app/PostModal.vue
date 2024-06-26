<script setup>
import {computed, ref, watch} from 'vue';
import {XMarkIcon, PaperClipIcon, BookmarkIcon, ArrowDownIcon , ArrowUturnLeftIcon } from "@heroicons/vue/24/solid";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import TextareaInput from "../TextareaInput.vue";
import PostUserProfile from "./PostUserProfile.vue";
import {useForm} from "@inertiajs/vue3";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {isImage} from "../../helpers.js";

const editor = ClassicEditor;

const editorConfig = {
    mediaEmbed: {
        removeProviders: [
            'dailymotion',
            'spotify',
            'youtube',
            'vimeo',
            'instagram',
            'twitter',
            'googleMaps',
            'flickr',
            'facebook'
        ]
    },
    toolbar: [
        'bold',
        'italic',
        '|',
        'bulletedList',
        'numberedList',
        '|',
        'heading',
        '|',
        'outdent',
        'indent',
        '|',
        'link',
        '|',
        'blockQuote'
    ],
}

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    modelValue: Boolean,
})

const attachmentFiles = ref([])


const form = useForm({
    body: '',
    attachments: [],
    deleted_file_ids: [],
    _method: 'POST'
})

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

const computedAttachments = computed(() => {
    return [...attachmentFiles.value, ...(props.post.attachments || [])]
})


const emit = defineEmits(['update:modelValue', 'hide'])

watch(() => props.post, () => {
    form.body = props.post.body || ''
})


function closeModal() {
    show.value = false
    emit('hide')
    resetModal();
}

function resetModal() {
    form.reset()
    attachmentFiles.value = []
    if (props.post.attachments) {
        props.post.attachments.forEach(file => file.deleted = false)
    }
}

function submit() {
    form.attachments = attachmentFiles.value.map(myFile => myFile.file)
    if (props.post.id) {
        form._method = 'PUT'
        form.post(route('post.update', props.post.id), {
            preserveScroll: true,
            onSuccess: () => {
                closeModal()
            }
        })
    } else {
        form.post(route('post.create'), {
            preserveScroll: true,
            onSuccess: () => {
                closeModal()
            }
        })
    }
}


async function onAttachmentChoose($event) {
    console.log($event.target.files)
    for (const file of $event.target.files) {
        const myFile = {
            file,
            url: await readFile(file)
        }
        attachmentFiles.value.push(myFile)
    }
    $event.target.value = null;
    console.log(attachmentFiles.value)
}

async function readFile(file) {
    return new Promise((res, rej) => {
        if (isImage( file)) {
            const reader = new FileReader();
            reader.onload = () => {
                res(reader.result)
            }
            reader.onerror = rej
            reader.readAsDataURL(file)
        } else {
            res(null)
        }
    })
}

function removeFile(myFile) {
    if (myFile.file) {
        attachmentFiles.value = attachmentFiles.value.filter(f => f !== myFile)
    } else {
        form.deleted_file_ids.push(myFile.id)
        myFile.deleted = true
    }
}

function undoDeleted(myFile) {
    myFile.deleted = false;
    form.deleted_file_ids = form.deleted_file_ids.filter(id => myFile.id !== id)
}


</script>

<template>
    <teleport to="body">
        <TransitionRoot appear :show="show" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-30">
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
                                class="w-full max-w-md transform overflow-hidden rounded-lg bg-white text-left
                                align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="flex items-center justify-between py-3 px-4 font-medium leading-6 bg-gray-100
                                    text-gray-900"
                                >
                                    {{ post.id ? 'Update Post' : 'Create new Post' }}
                                    <button @click="closeModal()"
                                            class="w-8 h-8 rounded-full hover:bg-black/5 transition  flex items-center
                                            justify-center">
                                        <XMarkIcon class="w-4 h-4"/>
                                    </button>
                                </DialogTitle>
                                <div class="p-4">
                                    <PostUserProfile :post="post" :show-time="false" class="mb-4"/>
                                    <ckeditor :editor="editor"
                                              v-model="form.body"
                                              :config="editorConfig">

                                    </ckeditor>

                                    <div class="grid gap-3 my-3" :class="[
                                        computedAttachments.length === 1 ? 'grid-cols-1' : 'grid-cols-2'
                                    ]">
                                        <template v-for="(myFile, ind) of computedAttachments">
                                            <div class=" group aspect-square bg-blue-100 flex flex-col items-center
                                                justify-center text-gray-500 relative"
                                            >
                                                <div v-if="myFile.deleted" class="absolute z-10 flex justify-between items-center left-0 bottom-0 right-0 py-2 px-3 text-sm
                                                bg-black text-white">
                                                    To be Deleted
                                                    <ArrowUturnLeftIcon @click="undoDeleted(myFile)" class="w-4 h-4 cursor-pointer" />
                                                </div>

                                                <button @click="removeFile(myFile)"
                                                        class="absolute z-20 right-2 top-2 w-7 h-7 flex items-center
                                                        justify-center rounded-full bg-black/20 text-white
                                                        hover:bg-black/40">
                                                    <XMarkIcon class="w-3 h-3"/>
                                                </button>
                                                <img v-if="isImage(myFile.file || myFile)"
                                                     :src="myFile.url"
                                                     class="object-cover w-full aspect-square"
                                                     :class="myFile.deleted ? 'opacity-50' : '' "
                                                     alt="attachment"
                                                />
                                                <div v-else class="flex flex-col items-center justify-center"
                                                     :class="myFile.deleted ? 'opacity-50' : ''">
                                                    <PaperClipIcon class="w-10 h-10 mb-3" />
                                                    <small class="text-center">
                                                        {{ (myFile.file || myFile).name}}
                                                    </small>

                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="p-3 flex justify-between gap-6">
                                    <button
                                        type="button"
                                        class=" relative flex items-center justify-center rounded-md bg-indigo-600 py-2
                                        text-sm font-semibold text-white shadow-sm hover:bg-indigo-500
                                        focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                        focus-visible:outline-indigo-600 w-[30%]"
                                    >
                                        <PaperClipIcon class="w-4 h-4 mr-2"/>
                                        Attach File
                                        <input @click.stop @change="onAttachmentChoose" type="file" multiple
                                               class="absolute w-full left-0 top-0 right-0 bottom-0 opacity-0"/>
                                    </button>
                                    <button
                                        type="button"
                                        class="flex items-center justify-center rounded-md bg-indigo-600 py-2 text-sm
                                        font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline
                                        focus-visible:outline-2 focus-visible:outline-offset-2
                                        focus-visible:outline-indigo-600 w-[30%]"
                                        @click="submit"
                                    >
                                        <BookmarkIcon class="w-4 h-4 mr-2"/>
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
