<script setup>

import FollowingListItems from "./FollowingListItems.vue";
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";


</script>

<template>
    <div class="px-3 bg-white rounded border h-full py-3 overflow-hidden">
        <div class="block lg:hidden">
            <Disclosure v-slot="{ open }">
                <DisclosureButton class="text-left w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">
                            My Followings
                        </h2>
                        <!--chevronIcon-->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             :class="open ? 'rotate-90 transform' : ''"
                             class="h-5 w-5 text-gray-800 transition-all">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </DisclosureButton>
                <DisclosurePanel>
                    <FollowingListItems />
                </DisclosurePanel>
            </Disclosure>
        </div>
        <div class="h-full overflow-hidden flex-col hidden lg:flex">
            <h2 class="text-xl font-bold">
                My Followings
            </h2>
            <FollowingListItems />
        </div>
    </div>

</template>

<style scoped>

</style>
