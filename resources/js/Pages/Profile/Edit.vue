<template>
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
            <ProfileInformationForm
                :status="status"
                class="max-w-xl"
            />
        </div>
</template>
<script setup>
import ProfileInformationForm from './Partials/ProfileInformationForm.vue';

defineProps({
    status: {
        type: String,
    },
});
</script>
