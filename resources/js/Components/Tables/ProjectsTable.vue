<script setup>
import { ref, computed } from "vue"
import { Link, router } from '@inertiajs/vue3'
import BasicTable from "@/Components/Tables/BasicTable.vue"
import SearchCaption from './SearchCaption.vue'
import { Pagination } from 'flowbite-vue'



const props = defineProps({
    data: {
        type: Array,
        required: false,
        default: []
    }
})

const fields = [
    { key: 'avatar', label: 'Cover', header: true },
    { key: 'title', label: 'Project Title', header: true },
    { key: 'url', label: 'Project Url', },
    // { key: 'description', label: 'Project Description', format: (item) => item },
    { key: 'actions', label: 'Actions' },
]

const keyWord = ref(null)

const currentPage = ref(1)

const data = computed(() => {
    return (!!keyWord.value)
        ? props.data.filter(item => {
               return item?.title.includes(keyWord.value)
                        || item?.url.includes(keyWord.value)
                        || item?.description.includes(keyWord.value)
                        || item?.avatar.includes(keyWord.value)
            })
        : props.data
    })

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        router.delete(route("projects.destroy", id));
    }
}

</script>
<template>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <BasicTable class="w-full text-sm text-left text-gray-500 dark:text-gray-400" :items="data" :fields="fields">
            <template #caption>
                <SearchCaption @onInput="(k) => { keyWord = ( k.length && k.length < 3 ) ? null : k }" />
            </template>
            <template #cell(avatar)="{ item }">
                <div class="">
                    <img :src="item.avatar" class="object-contain h-24" />
                </div>
            </template>
            <template #cell(url)="{ item }">
                <div class="min-w-4 p-2 whitespace-nowrap">{{ item.url }}</div>
            </template>
            <template #cell(title)="{ item }">
                <div class="min-w-4 p-2 whitespace-nowrap">{{ item.title }}</div>
            </template>
            <!-- <template #cell(description)="{ item }" class="w-4 p-6 whitespace-nowrap">
                <div class="min-w-4 p-2 whitespace-nowrap" v-html="item.description"></div>
            </template> -->
            <template #cell(actions)="{ item }" class="items-end">
                <Link :href="route('projects.edit', item.id)"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2"
                    @click="destroy(item.id)">Delete</button>
            </template>
        </BasicTable>
        <div class="my-2 flex justify-end">
            <Pagination v-model="currentPage" :total-pages="100" show-icons></Pagination>
        </div>

    </div>
</template>
