<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue"
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
    project: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    url: props.project?.url,
    title: props.project?.title,
    description: props.project?.description,
})

function submit()
{
    // console.log(form);
    form.put(route('projects.update', { project: props.project?.id }))
}

</script>
<template>
    <AdminLayout>
        <Head title="Edit Project" />

        <template #header>
            Edit Project
        </template>

        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="flex flex-col space-y-4">
                <!-- <div>
                    <input type="file" @input="form.avatar = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div> -->
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
                    <TextareaInput rows="4" v-model="form.description" />
                </div>
                <div>
                    <PrimaryButton class="uppercase">update</PrimaryButton>
                </div>
            </div>
        </form>
    </AdminLayout>
</template>
