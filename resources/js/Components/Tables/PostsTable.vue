<script setup>
import { ref } from "vue"
import { Link, router } from '@inertiajs/vue3'
import BasicTable from "@/Components/Tables/BasicTable.vue"
const props = defineProps({
    data: {
        type: Array,
        required: false,
        default: []
    }
})


const fields = ref([
    { key: 'avatar', label: 'Post Cover', },
    { key: 'title', label: 'Post title', },
    // { key: 'body', label: 'Post Body', format: (item) => item },
    { key: 'actions', label: 'Actions' },
])


function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        router.delete(route("posts.destroy", id));
    }
}
</script>
<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <BasicTable class="w-full text-sm text-left text-gray-500 dark:text-gray-400" :items="props.data" :fields="fields">
            <template #caption>
                <div class="flex items-center justify-between pb-4 ">
                    <div>
                        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            type="button">
                            <span class="sr-only">Action button</span>
                            Action
                            <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownAction"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownActionButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                        account</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                    User</a>
                            </div>
                        </div>
                    </div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for posts">
                    </div>
                </div>
            </template>
            <template #cell(avatar)="{ item }">
                <div class="">
                    <img :src="item?.avatar" class="object-contain h-24" />
                </div>
            </template>
            <template #cell(title)="{ item }">
                <div class="min-w-4 p-2 whitespace-nowrap">{{ item.title }}</div>
            </template>
            <!-- <template #cell(body)="{ item }">
                <div class="min-w-4 p-2 whitespace-nowrap">{{ item.body }}</div>
            </template> -->
            <template #cell(actions)="{ item }" class="items-end">
                <Link :href="route('posts.edit', item.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2"
                    @click="destroy(item.id)">Delete</button>
            </template>
        </BasicTable>
    </div>
</template>
