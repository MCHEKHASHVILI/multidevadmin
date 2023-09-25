<script setup>
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    message: {
        type: String,
        required: false,
        default: null,
    },
    post: {
        type: Object,
        required: true,
    }
})
const form = useForm({
    title: props.post?.title,
    body: props.post?.body,
})


</script>
<template>
    <AuthenticatedLayout>
        <Head title="Create Post" />

        <template #header>
            Edit Post
        </template>

        <form @submit.prevent="router.post(route('posts.update', { post: props.post?.id }), { _method: 'put', ...form })">
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
    </AuthenticatedLayout>
</template>
