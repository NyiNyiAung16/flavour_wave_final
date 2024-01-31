<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import storeReport from '@/composable/storeReport'
import { useToast } from 'vue-toastification';

const report = ref('');
const error = ref('');

const submitReport = () => {
    if(report.value.trim()){
        const data = {
            report: report.value.trim(),
            created_at:new Date().toLocaleString()
        };
        storeReport(data);
        report.value = '';
        useToast().success('create report is successful.',{
            timeout:2000
        });
    }else{
        error.value = 'Report is required';
        setTimeout(() => {
            error.value = '';
        }, 2000);
    }
}

</script>


<template>
    <div>
        <form @submit.prevent="submitReport" class="space-y-3 max-w-4xl">
            <h2 class="text-xl font-semibold my-1">Report To Excuetives</h2>
            <div>
                <textarea rows="5" v-model="report" class="w-full bg-gray-700 resize-none p-2 rounded border-none outline-none" placeholder="eg:something..."></textarea>
                <p class="text-sm text-red-500 my-1" v-if="error">{{ error }}</p>
            </div>
            <PrimaryButton>Report</PrimaryButton>
        </form>
    </div>
</template>
