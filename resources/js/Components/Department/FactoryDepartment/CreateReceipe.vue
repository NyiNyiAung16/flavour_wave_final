<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { errors } from '@/composable/editProductDetail';
import { useForm } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { useToast } from 'vue-toastification';

const form = useForm({
    'ingredient_id':0,
    'product_id':0,
    'amount_grams':0
});

const createReceipe = () => {
    form.post(route('receipe.store'),{
        onSuccess:()=>{
            form.reset();
            useToast().success('Create Receipe is successful.')
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
    <div>
        <form class="p-2" @submit.prevent="createReceipe">
            <h3 class="text-2xl font-bold text-center mb-3">Create Receipe</h3>
            <div class="max-w-3xl mx-auto space-y-4">
                <div>
                    <base-input
                        type="number"
                        label="Ingredient ID"
                        v-model="form.ingredient_id"
                        :error="form.errors.ingredient_id"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
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
                        label="Amount Grams"
                        v-model="form.amount_grams"
                        :error="form.errors.amount_grams"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>
