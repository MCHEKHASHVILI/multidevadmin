<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue"
import { Head, Link } from '@inertiajs/vue3'
import ProjectsTable from '@/Components/Tables/ProjectsTable.vue'

defineProps({
    projects: {
        type: Array,
        required: true
    }
})
</script>
<template>
    <AdminLayout>

        <Head title="Projects" />

        <template #header>Projects</template>

        <ProjectsTable :data="projects" />

    </AdminLayout>
</template>
