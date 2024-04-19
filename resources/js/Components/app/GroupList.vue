<script setup>

import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import GroupListItems from "./GroupListItems.vue";

</script>

<template>
    <div class="px-3 bg-white rounded border py-3 h-full overflow-hidden">
        <div class="block lg:hidden">
            <Disclosure v-slot="{ open }">
                <DisclosureButton class="text-left w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">
                            My Groups
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
                    <GroupListItems />
                </DisclosurePanel>
            </Disclosure>
        </div>
        <div class="h-[70vh] overflow-hidden flex-col hidden lg:flex">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold">
                    My Groups
                </h2>
            </div>
            <GroupListItems/>
        </div>
    </div>
</template>

<style scoped>

</style>
