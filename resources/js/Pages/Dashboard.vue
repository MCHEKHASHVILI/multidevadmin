<script setup>
// import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// const editorData = ref('<p>Content of the editor.</p>')
// const editorConfig = {}

// const onEditorInput = () => console.log(editorData)

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- <ckeditor :editor="ClassicEditor" v-model="editorData" :config="editorConfig" @input="onEditorInput"></ckeditor> -->
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
