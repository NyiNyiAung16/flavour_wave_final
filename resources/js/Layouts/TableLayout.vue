<script setup>
defineProps({
    headers: {
        type: Array,
        required: true,
    },
    isAdmin: {
        type: Boolean,
        required: true,
    },
    isDepartment: {
        type: Boolean,
        required: true,
    },
});
</script>

<template>
    <table class="min-w-[1400px] bg-white dark:bg-gray-800 sm:rounded-lg">
        <thead>
            <tr class="border-b head">
                <th class="py-3 pe-2">No.</th>
                <th class="py-3 text-center" v-for="(header,index) in headers" :key="index">{{ header }}</th>
                <th class="py-3 text-center" v-if="isAdmin && isDepartment">Action</th>
            </tr>
        </thead>
        <tbody>
            <slot name="tbody"/>
        </tbody>
    </table>
</template>
