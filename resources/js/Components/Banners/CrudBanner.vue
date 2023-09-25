<script setup>
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    crud: Object
})
</script>

<template>
    <div class="relative w-full h-48 rounded-sm bg-black bg-opacity-10 shadow-md hover:bg-opacity-20 ">
        <Link :href="route(`${crud.route}`)" class="absolute inset-0"></Link>
        <div class="flex flex-col w-full h-full justify-center items-center space-x-2">
            <h4>{{ crud?.title }}</h4>
            <h2>{{ crud?.count }}</h2>
        </div>
    </div>
</template>
