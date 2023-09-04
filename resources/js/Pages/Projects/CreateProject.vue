<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
// import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
// import { ckBox } from '@ckeditor/ckeditor5-ckfinder'

const form = useForm({
    url: '',
    title: '',
    description: '',
    avatar: '',
})

console.log(ClassicEditor);

const editorConfig = {
    ...ClassicEditor.config,
    simpleUpload: {
        // The URL that the images are uploaded to.
        uploadUrl: route('projects.imageUpload'),

        // // Enable the XMLHttpRequest.withCredentials property.
        // withCredentials: true,

        // // Headers sent along with the XMLHttpRequest to the upload server.
        // headers: {
        //     'X-CSRF-TOKEN': 'CSRF-Token',
        //     Authorization: 'Bearer <JSON Web Token>'
        // }
    }
}

const onEditorInput = () => console.log(form.description)

</script>
<template>
    <AdminLayout>

        <Head title="Create Project" />

        <template #header>
            Create Project
        </template>

        <form @submit.prevent="form.post(route('projects.store'))">
            <div class="flex flex-col space-y-4">
                <div>
                    <input type="file" @input="form.avatar = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
                <div>
                    <InputLabel>Project Public Url</InputLabel>
                    <TextInput v-model="form.url" class="w-full" />
                </div>
                <div>
                    <InputLabel>Project Title</InputLabel>
                    <TextInput v-model="form.title" class="w-full" />
                </div>
                <div>
                    <InputLabel>Project Description</InputLabel>
                    <ckeditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"
                        @input="onEditorInput"></ckeditor>
                    <!-- <TextareaInput rows="4" v-model="form.description" /> -->
                </div>
                <div>
                    <PrimaryButton type="submit" class="uppercase">submit</PrimaryButton>
                </div>
            </div>
        </form>
    </AdminLayout>
</template>
