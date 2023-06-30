<template>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th v-for="column in columns" :key="column.key" class="px-4 py-3">{{ column.label }}</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y">
                <tr v-for="(item, index) in items" :key="index">
                    <td v-for="column in columns" :key="column.key" class="px-4 py-3 text-sm">
                        {{ item[column.key] }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        columns: {
            type: Array,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        }
    }
}
</script>
