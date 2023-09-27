<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue';
// import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
// import { ckBox } from '@ckeditor/ckeditor5-ckfinder'

const props = defineProps({
    client: {
        type: Object,
        required: true,
    }
})


const form = useForm({
    name: props.client.name,
    company: props.client.company,
    url: props.client.url,
    description: props.client.description,
    avatar: props.client.avatar,
})

// console.log(ClassicEditor);

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

async function submit() {
    try {
        form.post(route('clients.update',
        {
            _method: 'put',
            client: props.client?.id,
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


// const onEditorInput = () => console.log(form.description)

</script>
<template>
    <AuthenticatedLayout>

        <Head title="Create Project" />

        <template #header>
            Edit Client Review
        </template>

        <form @submit.prevent="submit">
            <div class="flex flex-col space-y-4">
                <div>
                    <input type="file" @input="form.avatar = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
                <div>
                    <InputLabel>Representative Name</InputLabel>
                    <TextInput v-model="form.name" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel>Company Name</InputLabel>
                    <TextInput v-model="form.company" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.company" />
                </div>
                <div>
                    <InputLabel>Company Url</InputLabel>
                    <TextInput v-model="form.url" class="w-full" />
                    <InputError class="mt-2" :message="form.errors.url" />
                </div>
                <div>
                    <InputLabel>Note Description</InputLabel>
                    <ckeditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"
                        @input=""
                        ></ckeditor>
                        <InputError class="mt-2" :message="form.errors.description" />
                    <!-- <TextareaInput rows="4" v-model="form.description" /> -->
                </div>
                <div>
                    <PrimaryButton type="submit" class="uppercase">update</PrimaryButton>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
