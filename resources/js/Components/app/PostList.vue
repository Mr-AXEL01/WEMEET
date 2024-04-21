<script setup>

import PostItem from "./PostItem.vue";

const post1 = {
    user: {
        id: 1,
        avatar: 'https://randomuser.me/api/portraits/men/61.jpg',
        name: 'John Smith'
    },
    group: null,

    attachments: [
        {
            id: 1,
            name: 'test.png',
            url: 'https://picsum.photos/1000',
            mime: 'image/png'
        },
        {
            id: 2,
            name: 'test2.png',
            url: 'https://picsum.photos/1000',
            mime: 'image/png'
        },
        {
            id: 3,
            name: 'MyDocument.docx',
            url: '#',
            mime: 'application/msword'
        },
    ],

    body: `
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    Ab ducimus est fuga reiciendis repellendus! Earum facilis id perspiciatis
    porro temporibus?</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    Ab ducimus est fuga reiciendis repellendus! Earum facilis id perspiciatis
    porro temporibus?</p>
          `,
    created_at: '2024-03-19 15:23'
}

const post2 = {
    user: {
        id: 2,
        avatar: 'https://randomuser.me/api/portraits/men/62.jpg',
        name: 'James Does'
    },
    group: {
        id: 1,
        name: 'Laravel Developers',
    },

    body: `
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    Ab ducimus est fuga reiciendis repellendus! Earum facilis id perspiciatis
    porro temporibus?</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    Ab ducimus est fuga reiciendis repellendus! Earum facilis id perspiciatis
    porro temporibus?</p>
          `,
    created_at: '2024-03-19 15:23'
}

</script>

<template>
    <div class="overflow-auto lg:h-[77vh]">
        <PostItem :post="post1"/>
        <PostItem :post="post2"/>
    </div>
</template>

<style scoped>

</style>
