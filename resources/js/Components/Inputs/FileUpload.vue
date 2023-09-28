<template>
    <file-pond name="tempFile" ref="pond" :label-idle="label ?? 'Drop files here...'" v-bind:allow-multiple="false"
        accepted-file-types="image/jpeg, image/png" :server="serverConfig"

        v-on:init="handleFilePondInit"
        v-on:processfile="handleProcessFile"
        v-on:addfilestart="onUploadTrigerred" />
</template>

<script setup>
import { ref, defineEmits } from "vue"
import "filepond/dist/filepond.min.css"
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
import vueFilePond from "vue-filepond"
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type"
import FilePondPluginImagePreview from "filepond-plugin-image-preview"
import { usePage } from '@inertiajs/vue3'

defineProps({
    label: {
        type: String,
        required: false,
        default: null
    }
})
const emit = defineEmits(['onFileUpload', 'onUploadTrigerred'])
const myFiles = ref()

const pond = ref(null)

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const { props } = usePage()

const serverConfig = {
    process: {
        url: route('uploads.store'),
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': props._csrf_token
        },
        withCredentials: false
    }
}

const handleFilePondInit = () => {
    console.log("FilePond has initialized")
}

function handleProcessFile(){
    let input = document.querySelector('input[name="tempFile"]').value
    emit('onFileUpload', input)
}

function onUploadTrigerred(){
    emit('onUploadTrigerred')
}
</script>
