<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
    message: {
        type: String,
        required: false,
        default: '',
    }
})
const form = useForm({
    title: '',
    body: '',
    avatar: '',
})


</script>
<template>
    <AuthenticatedLayout>
        <Head title="Create Post" />

        <template #header>
            Create Post
        </template>

        <form @submit.prevent="form.post(route('posts.store'))">
            <div class="flex flex-col space-y-4">
                <div>
                    <input type="file" @input="form.avatar = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
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
