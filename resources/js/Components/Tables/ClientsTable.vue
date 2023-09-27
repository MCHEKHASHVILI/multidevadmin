<script setup>
import { ref } from "vue"
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

const fields = ref([
    { key: 'avatar', label: 'Post Cover', },
    { key: 'name', label: 'Client Name', },
    { key: 'company', label: 'Client Company', },
    { key: 'url', label: 'Client Company URL', },
    { key: 'description', label: 'Client Description', },
    // { key: 'body', label: 'Post Body', format: (item) => item },
    { key: 'actions', label: 'Actions' },
])

const keyWord = ref(null)

const currentPage = ref(1)

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        router.delete(route("clients.destroy", id));
    }
}
</script>
<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <BasicTable class="w-full text-sm text-left text-gray-500 dark:text-gray-400" :items="props.data" :fields="fields">
            <template #caption>
                <SearchCaption @onInput="(k) => { keyWord = ( k.length && k.length < 3 ) ? null : k }" />
            </template>
            <template #cell(avatar)="{ item }">
                <div class="">
                    <img :src="item.avatar" class="object-contain h-24" />
                </div>
            </template>
            <template #cell(actions)="{ item }" class="items-end">
                <Link :href="route('clients.edit', item.id)"
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
