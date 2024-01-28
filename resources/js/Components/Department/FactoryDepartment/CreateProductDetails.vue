<script setup>
import BaseInput from '@/Components/BaseInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    getData:{
        type:Object
    }
});

const form = useForm({
    product_id:0,
    quantity_per_box:0,
    expected:0,
    actual:0
});

const submitProductDetail = () => {
    form.post(route('factory.productDetails.store'),{
        onSuccess:()=>{
            form.reset();
        },
        onError:()=>{
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        }
    });
}

</script>


<template>
    <form @submit.prevent="submitProductDetail" class="py-3">
        <h3 class="text-2xl font-bold text-center mb-3">Create Product Details</h3>
        <div class="max-w-3xl mx-auto space-y-3">
            <div>
                <base-input
                    type="number"
                    label="Product ID"
                    v-model="form.product_id"
                    :error="form.errors.product_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-input
                    type="number"
                    label="Quantity Per Box"
                    v-model="form.quantity_per_box"
                    :error="form.errors.quantity_per_box"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-input
                    type="number"
                    label="Expected Quantity"
                    v-model="form.expected"
                    :error="form.errors.expected"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-input
                    type="number"
                    label="Actual Quantity"
                    v-model="form.actual"
                    :error="form.errors.actual"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div class="flex gap-3 items-center">
                <input type="checkbox" class="rounded-sm bg-gray-700 border-none">
                <span>Store to Warehouse?</span>
            </div>
            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </div>
    </form>
</template>

