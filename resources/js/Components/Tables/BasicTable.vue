<template>
    <table>
        <caption v-if="!!$slots.caption || caption">
            <slot name="caption">{{ caption }}</slot>
        </caption>
        <colgroup>
            <template v-for="field in displayedFields" :key="field.key">
                <slot :name="`col(${field.key})`">
                    <col>
                </slot>
            </template>
        </colgroup>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 whitespace-nowrap">
            <tr>
                <th scope="col" class="px-6 py-3" v-for="field in displayedFields">
                    <slot :name="`head(${field.key})`" :field="field">
                        {{ field.label }}
                    </slot>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <template v-for="key in displayedFieldKeys">
                    <Component :is="cellElement(key as string)" class="px-1">
                        <slot :name="`cell(${key})`" :value="format(item, (key as string))" :item="item"
                            :format="(k: string) => format(item, k)">
                            {{ format(item, (key as string)) }}
                        </slot>
                    </Component>
                </template>
            </tr>
        </tbody>
    </table>
</template>

<script lang="ts" setup>
import { computed, PropType } from 'vue';

interface TableField {
    key: string
    label: string
    format?: Function
    hidden?: boolean
    header?: boolean
}

interface TableItem {
    id: number
    [key: string]: unknown
}

const props = defineProps({
    fields: { type: Array as PropType<TableField[]>, default: () => [] },
    items: { type: Array as PropType<TableItem[]>, default: () => [] },
    caption: { type: String, default: null }
})

const displayedFields = computed(() => props.fields.filter((i) => !i.hidden))

const displayedFieldKeys = computed(() => {
    return Object.entries(displayedFields.value).map(([_key, value]) => value.key)
})

const cellElement = (key: string) => {
    const field = props.fields.find((f) => f.key === key)
    return field && field.header ? 'th' : 'td'
}

const format = (item: TableItem, key: string) => {
    const field = props.fields.find((f) => f.key === key)
    return field && field.format ? field.format(item[key]) : item[key]
}
</script>
