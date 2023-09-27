<script setup>
import { ref, watch } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue';
import TextareaInput from '@/Components/TextareaInput.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    project: {
        type: Object,
        required: true,
    }
})


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

const form = useForm({
    url: props.project?.url,
    title: props.project?.title,
    description: props.project?.description,
    avatar: props.project?.avatar
})

async function submit() {
    try {
        form.post(route('projects.update',
        {
            _method: 'put',
            project: props.project?.id,
        },{
            // avatar: form.avatar,
        }),
        {

            // forceFormData: true,
            onCancelToken: () => { console.log("onCancelToken:") },
            onBefore: () => { console.log("onBefore:") }, // GlobalEventCallback<'before'>,
            onStart: (start) => { console.log("onStart:", start.data) }, // GlobalEventCallback<'start'>,
            onProgress: (some) => { console.log("onProgress:", some) },// GlobalEventCallback<'progress'>,
            onFinish: (data) => { console.log("onFinish:", data) }, // GlobalEventCallback<'finish'>,
            onCancel: () => { console.log("onCancel:") }, // GlobalEventCallback<'cancel'>,
            onSuccess: () => { console.log("onSuccess:") }, // GlobalEventCallback<'success'>,
            onError: (err) => { console.log("onError:", err) }, // GlobalEventCallback<'error'>,
        })
    } catch (err) { console.log("counght errors", err) }
}

// watch(tempUrl, (val) => { displayCover.value.src = val })

</script>
<template>
    <AuthenticatedLayout>

        <Head title="Edit Project" />

        <template #header>
            Edit Project
        </template>
        <!-- <div class="w-1/2 h-auto mb-4 flex space-x-2" v-show="project.avatar || tempUrl"> -->
            <!-- <img class="object-cover" :src="coverPicture" /> -->
            <!-- <button v-if="custom" @click.prevent="custom = true">Cancel</button> -->
        <!-- </div> -->
        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="flex flex-col space-y-4">
                <div>
                    <input type="file" @change="form.avatar = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
                <div>
                    <InputLabel>Project Public Url</InputLabel>
                    <TextInput v-model="form.url" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.url" />
                </div>
                <div>
                    <InputLabel>Project Title</InputLabel>
                    <TextInput v-model="form.title" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <div>
                    <InputLabel>Project Description</InputLabel>
                    <!-- <TextareaInput rows="4" v-model="form.description" /> -->
                    <ckeditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"
                        @input=""
                        ></ckeditor>
                        <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div>
                    <PrimaryButton class="uppercase">update</PrimaryButton>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
