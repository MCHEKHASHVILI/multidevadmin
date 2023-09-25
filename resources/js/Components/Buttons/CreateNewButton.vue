<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
    value: String,
    url: String
})
</script>
<template>
    <Link :href="url"
        class="py-2 px-4 rounded-lg bg-green-800 text-white bg-opacity-70 hover:bg-opacity-100">{{ value }}</Link>
</template>
