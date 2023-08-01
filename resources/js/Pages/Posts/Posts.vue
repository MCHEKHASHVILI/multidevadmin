<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue"
import { Head, Link } from '@inertiajs/vue3'

import PostsTable from "@/Components/Tables/PostsTable.vue"
defineProps({
    posts: {
        type: Array,
        required: true
    }
})
</script>
<template>
    <AdminLayout>

        <Head title="Posts" />

        <template #header>Posts</template>

        <PostsTable :data="posts" />

    </AdminLayout>
</template>
