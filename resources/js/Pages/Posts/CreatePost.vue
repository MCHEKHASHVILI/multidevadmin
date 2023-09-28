<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import TextareaInput from '@/Components/TextareaInput.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import FileUpload from '@/Components/Inputs/FileUpload.vue'



defineProps({
    message: {
        type: String,
        required: false,
        default: '',
    }
})

const editorConfig = {
    ...ClassicEditor.config,
    ckfinder: {
        uploadUrl: route('uploads.gallery'), // url to server-side http endpoint // mandatory
        'X-CSRF-TOKEN': pageProps._csrf_token, // csrf token for laravel
        withCredentials: false, // csrf token for laravel
    }
}


const form = useForm({
    title: '',
    body: '',
    avatar: '',
})

function onFileUpload(key)
{
    form.avatar = key
}

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
                    <!-- <input type="file" @input="form.avatar = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress> -->
                    <InputLabel>Avatar</InputLabel>
                    <FileUpload @onFileUpload="onFileUpload" label="Drop Avatar"/>
                </div>
                <div>
                    <InputLabel>Post Title</InputLabel>
                    <TextInput v-model="form.title" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <div>
                    <InputLabel>Post Body</InputLabel>
                    <ckeditor :editor="ClassicEditor" v-model="form.body" :config="editorConfig"
                        @input=""
                        ></ckeditor>
                    <InputError class="mt-2" :message="form.errors.body" />
                    <!-- <TextareaInput rows="4" v-model="form.body" /> -->
                </div>
                <div>
                    <PrimaryButton class="uppercase">submit</PrimaryButton>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
