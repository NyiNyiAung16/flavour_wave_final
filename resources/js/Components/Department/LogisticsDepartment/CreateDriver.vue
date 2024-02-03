<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    'name':'',
    'vehicle_number':''
});

const createDriver = () => {
    form.post(route('driver.store'),{
        onSuccess:()=>{
            form.reset()
        },
        onError:()=>{
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        },
        preserveScroll:true
    })
}

</script>


<template>
    <div class="py-3">
        <form @submit.prevent="createDriver" class="space-y-4 max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold text-center">Create Driver</h3>
            <div>
                <BaseInput
                    type="text"
                    label="Name"
                    v-model="form.name"
                    :error="form.errors.name"
                    placeholder="eg:U Myo"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <BaseInput
                    type="text"
                    label="Vehicle Number"
                    v-model="form.vehicle_number"
                    :error="form.errors.vehicle_number"
                    placeholder="eg:2C/9800"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

