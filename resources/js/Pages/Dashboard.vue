<script setup>
import { onMounted } from "vue"
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import CrudBanner from '@/Components/Banners/CrudBanner.vue'

defineProps({
    resources: Array | Object
})
onMounted(() => router.reload({ only: ['resources'] }))
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="grid gap-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                <CrudBanner v-for="crud in resources" :crud="crud"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
