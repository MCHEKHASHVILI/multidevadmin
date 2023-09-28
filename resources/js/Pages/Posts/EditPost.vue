<script setup>
import { ref } from "vue"
import { Head, useForm, usePage } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import FileUpload from '@/Components/Inputs/FileUpload.vue'

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

const { props: pageProps } = usePage()

// console.log(pageProps);

const editorConfig = {
    ...ClassicEditor.config,
    ckfinder: {
        uploadUrl: route('uploads.gallery'), // url to server-side http endpoint // mandatory
        'X-CSRF-TOKEN': pageProps._csrf_token, // csrf token for laravel
        withCredentials: false, // csrf token for laravel
    }
    // ckfinder: {
        // uploadUrl: route('uploads.gallery'),
        // headers: {
            // 'X-CSRF-TOKEN': pageProps._csrf_token,
        // },
        // withCredentials: false,
    // }
}

const form = useForm({
    title: props.post?.title,
    body: props.post?.body,
    avatar: '',
})
const readyToSubmit = ref(true)
const updateImage = ref(props.post?.avatar)
function onFileUpload(key) {
    form.avatar = key
    readyToSubmit.value = true
    console.log('uploaded')
}
function onUploadTrigerred() {
    readyToSubmit.value = false
    console.log('trigerred')
}
function submit() {
    form.put(route('posts.update', props.post?.id))
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Create Post" />
        <template #header>Edit Post</template>
        <form @submit.prevent="submit">
            <div class="flex flex-col space-y-4">
                <div>
                    <InputLabel>Avatar</InputLabel>
                    <div class="flex justify-start space-x-2" v-if="updateImage">
                        <div class="w-64">
                            <img :src="updateImage" class="object-cover aspect-square" />
                        </div>
                        <div class="flex-1">
                            <button class="py-2 px-4 rounded-lg bg-green-800 text-white bg-opacity-70 hover:bg-opacity-100"
                                @click.prevent="updateImage = null">Edit Avatar</button>
                        </div>
                    </div>
                    <div class="flex justify-start space-x-2" v-else>
                        <div class="w-64">
                            <FileUpload @onFileUpload="onFileUpload" @onUploadTrigerred="onUploadTrigerred"
                                label="Drop Avatar" />
                        </div>
                        <div class="flex-1">
                            <button class="py-2 px-4 rounded-lg bg-green-800 text-white bg-opacity-70 hover:bg-opacity-100"
                                @click.prevent="updateImage = post.avatar">cancel</button>
                        </div>
                    </div>
                </div>
                <div>
                    <InputLabel>Post Title</InputLabel>
                    <TextInput v-model="form.title" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <div>
                    <InputLabel>Post Body</InputLabel>
                    <ckeditor
                        :editor="ClassicEditor"
                        v-model="form.body"
                        :config="editorConfig"></ckeditor>
                    <InputError class="mt-2" :message="form.errors.body" />
                </div>
                <div>
                    <PrimaryButton class="uppercase" :disabled="!readyToSubmit">submit</PrimaryButton>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
