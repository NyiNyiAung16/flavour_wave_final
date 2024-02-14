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
    <div class="table-container">
        <table class="min-w-[100%] bg-white dark:bg-gray-800 sm:rounded-lg">
            <thead>
                <tr class="border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th
                        class="py-3 text-center"
                        v-for="(header, index) in headers"
                        :key="index"
                    >
                        {{ header }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <slot name="tbody" />
            </tbody>
        </table>
    </div>
</template>
<style scoped>
.table-container {
    /* max-height: 470px; */
    max-height: var(--table-container-max-height, 470px);
    overflow-y: auto;
}
/* .isAdmin .isDepartment-FACTORY .table-container {
    --table-container-max-height: 450px;
} */
table thead tr {
    position: sticky;
    top: 0;
    background-color: #1f2937;
    z-index: 1;
}
</style>
