<script setup>
import BaseInput from '@/Components/BaseInput.vue';
import Button from '@/Components/Button.vue';
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
    <div>
        <form @submit.prevent="createDeliver" class="space-y-4 max-w-4xl">
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
                <Button
                    type="button"
                    text="Deliver"
                    class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold"
                />
            </div>
        </form>
    </div>
</template>

