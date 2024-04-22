<template>
    <AuthentificationLayout>
        <div class="w-[80%] h-full mx-auto">
            <div class="relative bg-white">
                <img src="https://www.prodraw.net/fb_cover/images/fb_cover_51.jpg" alt="cover"
                     class="w-full h-[200px] object-cover rounded-lg"
                >
               <div class="flex">
                   <img src="https://mir-s3-cdn-cf.behance.net/project_modules/hd/d95c1f148207527.62d1246c25004.jpg" alt="avatar"
                        class="rounded-full w-[128px] h-[128px] ml-[48px] -mt-[80px]"
                   >
                   <div class="flex justify-between items-center flex-1  px-2 py-1">
                       <div>
                           <h2 class="font-bold lg:text-lg">
                               {{user.name}}
                           </h2>
                           <small class="text-gray-600">
                               {{user.username}}
                           </small>
                       </div>
                       <button class="flex items-center space-x-2 text-white p-2 rounded-lg bg-gray-700 border">
                           <PencilIcon class="w-[13px] lg:w-5 lg:h-5 " />
                           <p class="md:block hidden">Edit profile</p>
                       </button>
                   </div>
               </div>
            </div>
            <div class="border-t">
                <TabGroup>
                    <TabList class="flex bg-white flex-wrap">
                        <Tab v-slot="{ selected }" as="template">
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
                        <TabPanel key="about" class="bg-white p-3 shadow">
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
import { PencilIcon } from '@heroicons/vue/24/solid';

defineProps({
    user: {
        type: Object
    }
})
</script>
