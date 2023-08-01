<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
    message: {
        type: String,
        required: false,
        default: null,
    }
})
const form = useForm({
    title: null,
    body: null,
})


</script>
<template>
    <AdminLayout>
        <Head title="Create Post" />

        <template #header>
            Create Post
        </template>

        <form @submit.prevent="form.post(route('posts.store'))">
            <div class="flex flex-col space-y-4">
                <div>
                    <InputLabel>Post Title</InputLabel>
                    <TextInput v-model="form.title" class="w-full" />
                </div>
                <div>
                    <InputLabel>Post Body</InputLabel>
                    <TextareaInput rows="4" v-model="form.body" />
                </div>
                <div>
                    <PrimaryButton class="uppercase">submit</PrimaryButton>
                </div>
            </div>
        </form>
    </AdminLayout>
</template>
