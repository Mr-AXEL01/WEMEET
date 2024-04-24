<template>
    <AuthenticationLayout>
        <div class="max-w-[80%] h-full mx-auto ">
            <div
                v-show="showNotification && success"
                class="lg:w-[35%] my-2 py-2 px-3 font-medium text-sm bg-green-500 text-white rounded-lg"
            >
                {{ success }}
            </div>
            <div
                v-if="errors.cover"
                class="lg:w-[35%] my-2 py-2 px-3 font-medium text-sm bg-red-500 text-white rounded-lg"
            >
                {{ errors.cover }}
            </div>
            <div class="relative bg-white rounded-lg">
                <div class="group/cover">
                    <img :src="coverImageSrc || user.cover_url || '/img/default_cover.jpg' " :alt="`${user.username}'s cover`"
                    class="w-full h-[200px] object-cover rounded-lg"
                    >
                    <div v-if="isMyProfile" class="absolute top-2 right-2">
                        <button v-if="!coverImageSrc"
                                class="bg-gray-50 hover:bg-gray-100 rounded-full p-2 opacity-0 group-hover/cover:opacity-100">
                            <PhotoIcon class="w-3 h-3 text-blue-500"/>
                            <input type="file" class="absolute left-0 op-0 bottom-0 right-0 opacity-0 cursor-pointer"
                                   @change="onCoverChange"
                            />
                        </button>
                        <div v-else class="flex gap-2">
                            <button @click="resetCoverImage"
                                    class="flex items-center p-1 gap-1 text-xs rounded-lg bg-gray-50 text-red-500 hover:bg-red-500 hover:text-white ">
                                <XMarkIcon class="w-3 h-3"/>
                                cancel
                            </button>
                            <button @click="submitCoverImage"
                                    class="flex items-center p-1 gap-1 text-xs rounded-lg bg-gray-50 text-green-500 hover:bg-green-500 hover:text-white">
                                <CheckIcon class="w-3 h-3"/>
                                submit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="group/avatar">
                        <img
                            :src="avatarImageSrc || user.avatar_url || '/img/default_avatar.jpg'"
                            :alt="`${user.username}'s avatar`"
                            class="rounded-full object-cover w-[128px] h-[128px] ml-[48px] -mt-[80px]"
                        >
                        <div v-if="isMyProfile" class="absolute flex flex-col left-[2.5rem] bottom-0 lg:bottom-1">
                            <div v-if="avatarImageSrc" class="flex gap-2 ml-2">
                                <button @click="resetAvatarImage"
                                        class="flex items-center p-1 gap-1 text-xs rounded-lg bg-gray-50 text-red-500 hover:bg-red-500 hover:text-white ">
                                    <XMarkIcon class="w-3 h-3"/>
                                    cancel
                                </button>
                                <button @click="submitAvatarImage"
                                        class="flex items-center p-1 gap-1 text-xs rounded-lg bg-gray-50 text-green-500 hover:bg-green-500 hover:text-white">
                                    <CheckIcon class="w-3 h-3"/>
                                    submit
                                </button>
                            </div>
                            <button v-else class=" p-2 opacity-0 group-hover/avatar:opacity-100">
                                <CameraIcon
                                    class="w-32 h-32 border-[3px] p-10 border-blue-500 rounded-full bg-black/50 text-gray-400"/>
                                <input type="file"
                                       class="absolute rounded-full w-[87%] h-[73%] left-2 top-9 bottom-0 right-0 opacity-0 cursor-pointer"
                                       @change="onAvatarChange"
                                />
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center flex-1 lg:mx-3 pb-2 px-2">
                        <div>
                            <h2 class="font-bold lg:text-lg">
                                {{ user.name }}
                            </h2>
                            <small class="text-gray-600">
                                {{ user.username }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t">
                <TabGroup>
                    <TabList class="flex bg-white flex-wrap">
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Posts" :selected="selected"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Followers" :selected="selected"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Following" :selected="selected"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Photos" :selected="selected"/>
                        </Tab>
                        <Tab v-if="isMyProfile" v-slot="{ selected }" as="template">
                            <TabItem text="My Profile" :selected="selected"/>
                        </Tab>
                    </TabList>

                    <TabPanels class="mt-2 lg:h-[32rem] lg:overflow-auto">
                        <TabPanel key="posts" class="bg-white p-3 shadow">
                            Post Content
                        </TabPanel>
                        <TabPanel key="followers" class="bg-white p-3 shadow">
                            Followers Content
                        </TabPanel>
                        <TabPanel key="followings" class="bg-white p-3 shadow">
                            Followings Content
                        </TabPanel>
                        <TabPanel key="photos" class="bg-white p-3 shadow">
                            Photos Content
                        </TabPanel>
                        <TabPanel v-if="isMyProfile" key="My Profile" class="bg-white p-3 shadow h-[70%] overflow-auto">
                            <Edit :status="status"/>
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticationLayout>

</template>

<script setup>
import {TabGroup, TabList, Tab, TabPanels, TabPanel} from '@headlessui/vue';
import AuthenticationLayout from "../../Layouts/AuthenticationLayout.vue";
import TabItem from "./Partials/TabItem.vue";
import {PencilIcon, CameraIcon , PhotoIcon, XMarkIcon, CheckIcon} from '@heroicons/vue/24/solid';
import {useForm, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import Edit from "./Edit.vue";

const imagesForm = useForm({
    avatar: null,
    cover: null,
});

const showNotification = ref(true)
const avatarImageSrc = ref('');
const coverImageSrc = ref('');
const authUser = usePage().props.auth.user;
const isMyProfile = computed(() => authUser && authUser.id === props.user.id);


const props = defineProps({
    errors: Object,
    status: {
        type: String,
    },
    success: {
        type: String,
    },
    user: {
        type: Object
    }
});

function onCoverChange(event) {
    imagesForm.cover = event.target.files[0]
    if (imagesForm.cover) {
        const reader = new FileReader()
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        }
        reader.readAsDataURL(imagesForm.cover)
    }
}

function onAvatarChange(event) {
    imagesForm.avatar = event.target.files[0]
    if (imagesForm.avatar) {
        const reader = new FileReader()
        reader.onload = () => {
            avatarImageSrc.value = reader.result;
        }
        reader.readAsDataURL(imagesForm.avatar)
    }
}

function resetCoverImage() {
    imagesForm.cover = null;
    coverImageSrc.value = null;
}

function resetAvatarImage() {
    imagesForm.avatar = null;
    avatarImageSrc.value = null;
}

function submitCoverImage() {
    imagesForm.post(route('profile.updateImages'), {
        onSuccess: (user) => {
            resetCoverImage()
            setTimeout(() => {
                showNotification.value = false;
            }, 2000)
        },

    })
}

function submitAvatarImage() {
    imagesForm.post(route('profile.updateImages'), {
        onSuccess: (user) => {
            resetAvatarImage()
            setTimeout(() => {
                showNotification.value = false;
            }, 2000)
        },

    })
}

</script>
