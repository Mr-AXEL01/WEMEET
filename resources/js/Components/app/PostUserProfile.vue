<script setup>

defineProps({
    post: {
        type: Object
    },
    showTime: {
        type: Boolean,
        default: true,
    }
})


</script>

<template>
    <div class="flex items-center gap-2">
        <a :href="`/u/${post.user ? post.user.username : ''}`">
            <img :src="post.user.avatar_url || '/img/default_avatar.jpg'"
                 class="w-[40px] h-[40px] object-cover rounded-full border border-2 transition-all
                     hover:border-blue-500"
            />
        </a>
        <div>
            <h4 class="font-bold">
                <a :href="`/u/${post.user ? post.user.username : ''}`" class="hover:underline">
                    {{ post.user.name }}
                </a>
                <template v-if="post.group">
                    >
                    <a href="javascript:void(0)" class="hover:underline">
                        {{ post.group.name }}
                    </a>
                </template>
            </h4>
            <small v-if="showTime" class="text-gray-400">
                {{ post.updated_at }}
            </small>
        </div>
    </div>
</template>
