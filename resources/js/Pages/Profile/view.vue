<template>
    <AuthenticationLayout>
        <div class="w-[80%] h-full mx-auto overflowY-auto">
            <div
                v-show="showNotification && status === 'cover-update'"
                class="lg:w-[35%] my-2 py-2 px-3 font-medium text-sm bg-green-600 text-white rounded-lg"
            >
                Your cover image has been updated successfully
            </div>
            <div class="group relative bg-white">
                <img :src="coverImageSrc || user.cover_url || '/img/default_cover.jpg' " alt="cover"
                     class="w-full h-[200px] object-cover rounded-lg"
                >
                <div class="absolute top-2 right-2">
                    <button v-if="!coverImageSrc" class="bg-gray-50 hover:bg-gray-100 rounded-full p-2 opacity-0 group-hover:opacity-100">
                        <PhotoIcon class="w-3 h-3 text-blue-500" />
                        <input type="file" class="absolute left-0 op-0 bottom-0 right-0 opacity-0 cursor-pointer"
                               @change="onCoverChange"
                        />
                    </button>
                    <div v-else class="flex gap-2">
                        <button @click="cancelCoverImage" class="flex items-center p-1 gap-1 text-xs rounded-lg bg-gray-50 text-red-500 hover:bg-red-500 hover:text-white ">
                            <XMarkIcon class="w-3 h-3" />
                            cancel
                        </button>
                        <button @click="submitCoverImage" class="flex items-center p-1 gap-1 text-xs rounded-lg bg-gray-50 text-green-500 hover:bg-green-500 hover:text-white">
                            <CheckIcon class="w-3 h-3" />
                            submit
                        </button>
                    </div>
                </div>
               <div class="flex">
                   <img src="https://mir-s3-cdn-cf.behance.net/project_modules/hd/d95c1f148207527.62d1246c25004.jpg" alt="avatar"
                        class="rounded-full w-[128px] h-[128px] ml-[48px] -mt-[80px]"
                   >
                   <div class="flex justify-between items-center flex-1 lg:mx-3 pb-2 px-2">
                       <div>
                           <h2 class="font-bold lg:text-lg">
                               {{user.name}}
                           </h2>
                           <small class="text-gray-600">
                               {{user.username}}
                           </small>
                       </div>
                       <button v-if="isMyProfile" class="flex items-center space-x-2 text-white p-2 rounded-[10px] bg-blue-950 hover:bg-gray-20;fmop0 hover:text-gray-800 border-2">
                           <PencilIcon class="w-[13px] lg:w-5 lg:h-5 " />
                           <b class="md:block hidden">Edit profile</b>
                       </button>
                   </div>
               </div>
            </div>
            <div class="border-t">
                <TabGroup>
                    <TabList class="flex bg-white flex-wrap">
                        <Tab v-if="isMyProfile" v-slot="{ selected }" as="template">
                            <TabItem text="About" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Posts" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Followers" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Following" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Photos" :selected="selected" />
                        </Tab>
                    </TabList>

                    <TabPanels class="mt-2">
                        <TabPanel v-if="isMyProfile" key="about" class="bg-white p-3 shadow">
                            About Content
                        </TabPanel>
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
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticationLayout>

</template>

<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import AuthenticationLayout from "../../Layouts/AuthenticationLayout.vue";
import TabItem from "./Partials/TabItem.vue";
import { PencilIcon , PhotoIcon , XMarkIcon , CheckIcon } from '@heroicons/vue/24/solid';
import {useForm, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const imagesForm = useForm({
   avatar: null,
    cover:null,
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
    user: {
        type: Object
    }
});

function onCoverChange(event) {
    imagesForm.cover = event.target.files[0]
    if(imagesForm.cover){
        const reader = new FileReader()
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        }
        reader.readAsDataURL(imagesForm.cover)
    }
}

function cancelCoverImage() {
    imagesForm.cover = null;
    coverImageSrc.value = null;
}

function submitCoverImage() {
    imagesForm.post(route('profile.updateCover'), {
        onSuccess: (user) => {
            cancelCoverImage()
            setTimeout(() => {
                showNotification.value = false ;
            }, 2000)
        },
    })
}

</script>
