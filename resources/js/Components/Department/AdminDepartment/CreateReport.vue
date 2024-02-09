<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useToast } from 'vue-toastification';
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    'body':''
});

const submitReport = () => {
    form.post(route('report.store'),{
        onSuccess:() => {
            form.reset();
            useToast().success('Create Report is successful.')
        },
        onError:() => {
            setTimeout(()=>{
                form.clearErrors();
            },2000)
        }
    });
}

</script>


<template>
    <div class="p-3">
        <form @submit.prevent="submitReport" class="space-y-3 max-w-4xl">
            <h2 class="text-xl font-semibold my-1">Report To Excuetives</h2>
            <div>
                <textarea rows="5" v-model="form.body" class="w-full bg-gray-700 resize-none p-2 rounded border-none outline-none" placeholder="eg:something..."></textarea>
                <p class="text-sm text-red-500 my-1" v-if="form.errors.body">{{ form.errors.body }}</p>
            </div>
            <PrimaryButton>Report</PrimaryButton>
        </form>
    </div>
</template>
