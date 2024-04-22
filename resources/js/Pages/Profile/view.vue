<template>
    <AuthentificationLayout>
        <div class="w-[80%] h-full mx-auto">
            <div class="group relative bg-white">
                <img :src="coverImageSrc || user.cover_url || '/img/default_cover.jpg' " alt="cover"
                     class="w-full h-[200px] object-cover rounded-lg"
                >
                <button class="absolute top-2 right-2 p-2 opacity-0 group-hover:opacity-100">
                    <PhotoIcon class="w-4 h-4 text-white" />
                    <input type="file" class="absolute left-0 op-0 bottom-0 right-0 opacity-0 cursor-pointer"
                           @change="onCoverChange"
                    />
                </button>
               <div class="flex">
                   <img src="https://mir-s3-cdn-cf.behance.net/project_modules/hd/d95c1f148207527.62d1246c25004.jpg" alt="avatar"
                        class="rounded-full w-[128px] h-[128px] ml-[48px] -mt-[80px]"
                   >
                   <div class="flex justify-between items-center flex-1  px-2">
                       <div>
                           <h2 class="font-bold lg:text-lg">
                               {{user.name}}
                           </h2>
                           <small class="text-gray-600">
                               {{user.username}}
                           </small>
                       </div>
                       <button v-if="isMyProfile" class="flex items-center space-x-2 text-white p-2 rounded-lg bg-gray-700 border">
                           <PencilIcon class="w-[13px] lg:w-5 lg:h-5 " />
                           <p class="md:block hidden">Edit profile</p>
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
    </AuthentificationLayout>

</template>

<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import AuthentificationLayout from "../../Layouts/AuthentificationLayout.vue";
import TabItem from "./Partials/TabItem.vue";
import { PencilIcon , PhotoIcon } from '@heroicons/vue/24/solid';
import {usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const coverImageSrc = ref('');
const authUser = usePage().props.auth.user;
const isMyProfile = computed(() => authUser && authUser.id === props.user.id);

const props = defineProps({
    user: {
        type: Object
    }
});


function onCoverChange(event)
{
    console.log(event)
    const file = event.target.files[0]
    if(file){
        const reader = new FileReader()
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        }
        reader.readAsDataURL(file)
    }
}
</script>
