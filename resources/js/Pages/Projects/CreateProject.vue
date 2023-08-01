<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue"
import { Head } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const form = useForm({
    url: null,
    title: null,
    description: null,
    avatar: null,
})

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
                    <TextareaInput rows="4" v-model="form.description" />
                </div>
                <div>
                    <PrimaryButton class="uppercase">submit</PrimaryButton>
                </div>
            </div>
        </form>
    </AdminLayout>
</template>
