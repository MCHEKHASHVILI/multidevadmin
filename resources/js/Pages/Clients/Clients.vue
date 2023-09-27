<script setup>
import { onMounted } from "vue"
import { Head, router } from '@inertiajs/vue3'

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import ClientsTable from '@/Components/Tables/ClientsTable.vue'
import CreateNewButton from '@/Components/Buttons/CreateNewButton.vue'

defineProps({
    clients: {
        type: Array,
        required: true
    }
})

onMounted(() => {
    router.reload({ only: ['clients'] })
})
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Clients" />

        <template #header>
            <div class="w-full flex flex-row justify-between">
                <h1>Client Reviews</h1>
                <CreateNewButton value="New Client Review" :url="route('clients.create')" />
            </div>
        </template>

        <ClientsTable :data="clients" />

    </AuthenticatedLayout>
</template>
