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
    <div>
        <!-- changed to 100% -->
        <table class="min-w-[100%] px-2">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3 pe-2">No.</th>
                    <th
                        class="py-3 text-center"
                        v-for="(header, index) in headers"
                        :key="index"
                    >
                        {{ header }}
                    </th>
                    <th class="py-3 text-center" v-if="isAdmin && isDepartment">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <slot name="tbody" />
            </tbody>
        </table>
    </div>
</template>
