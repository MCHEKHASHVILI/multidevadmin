<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { Head } from '@inertiajs/vue3'
import PostsTable from "@/Components/Tables/PostsTable.vue"
import CreateNewButton from '@/Components/Buttons/CreateNewButton.vue'

defineProps({
    posts: {
        type: Array,
        required: true
    }
})
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Posts" />

        <template #header>
            <div class="w-full flex flex-row justify-between">
                <h4>Posts</h4>
                <CreateNewButton value="New Post" :url="route('posts.create')" />
            </div>
        </template>

        <PostsTable :data="posts" />

    </AuthenticatedLayout>
</template>
