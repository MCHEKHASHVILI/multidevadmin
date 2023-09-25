<script setup>
import { onMounted } from "vue"
import { Head, router } from '@inertiajs/vue3'

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import ProjectsTable from '@/Components/Tables/ProjectsTable.vue'
import CreateNewButton from '@/Components/Buttons/CreateNewButton.vue'

defineProps({
    projects: {
        type: Array,
        required: true
    }
})

onMounted(() => {
    router.reload({ only: ['projects'] })
})
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Projects" />

        <template #header>
            <div class="w-full flex flex-row justify-between">
                <h1>Projects</h1>
                <CreateNewButton value="New Project" :url="route('projects.create')" />
            </div>
        </template>

        <ProjectsTable :data="projects" />

    </AuthenticatedLayout>
</template>
