<script setup>
import { ref, watch } from "vue"
defineProps({
    placeholder: {
        type: String,
        required: false,
        default: 'Search',
    }
})
const searchKeyWord = ref(null)

defineEmits(['onInput'])
</script>
<template>
    <div class="flex items-center justify-between pb-4 bg-transparent">
        <div>
            <slot name="left"></slot>
        </div>
        <slot name="label">
            <label for="table-search" class="sr-only">Search</label>
        </slot>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <slot name="iconSvg">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </slot>
            </div>
            <input type="text" @input="this.$emit('onInput', searchKeyWord)" v-model="searchKeyWord"
                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                :placeholder="placeholder">
        </div>
    </div>
</template>
