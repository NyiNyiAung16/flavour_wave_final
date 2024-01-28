<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';

const reports = ref(null);

onMounted(()=>{
    reports.value = JSON.parse(localStorage.getItem('reports')) ?? [];
});

</script>


<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left border-b head">
                    <th class="py-3">No.</th>
                    <th class="py-3">Report</th>
                    <th class="py-3">Created_at</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b item" v-for="(report,index) in reports" :key="report.created_at">
                    <td class="py-4">{{ index }}</td>
                    <td class="py-4">{{ report.report }}</td>
                    <td class="py-4">{{ report.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

