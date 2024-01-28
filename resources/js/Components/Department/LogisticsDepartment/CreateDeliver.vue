<script setup>
import BaseInput from '@/Components/BaseInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    'preorder_id':0,
    'quantity':0,
    'driver_id':0
});

const createDeliver = () => {
    form.post(route('deliver.store'),{
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
        <form @submit.prevent="createDeliver" class="space-y-4 max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold text-center">Create Deliver</h3>
            <div>
                <BaseInput
                    type="number"
                    label="Preorder ID"
                    v-model="form.preorder_id"
                    :error="form.errors.preorder_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <BaseInput
                    type="number"
                    label="Quantity"
                    v-model="form.quantity"
                    :error="form.errors.quantity"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <BaseInput
                    type="number"
                    label="Driver ID"
                    v-model="form.driver_id"
                    :error="form.errors.driver_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

