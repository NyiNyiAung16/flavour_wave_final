<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const form = useForm({
    'name':'',
    'source':'',
    'amount':0,
    'unit_price':0
});


const createIngredient = () => {
    form.post(route('ingredient.store'),{
        onSuccess:()=>{
            form.reset();
            useToast().success('Create Ingredient is successful.')
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
        <form class="p-2" @submit.prevent="createIngredient">
            <h3 class="text-2xl font-bold text-center mb-3">Create Ingredient</h3>
            <div class="max-w-3xl mx-auto space-y-4">
                <div>
                    <base-input
                        type="text"
                        label="Name"
                        v-model="form.name"
                        :error="form.errors.name"
                        placeholder="eg:Black Tea leaves"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <base-input
                        type="text"
                        label="Source"
                        v-model="form.source"
                        :error="form.errors.source"
                        placeholder="CityMark"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <base-input
                        type="number"
                        label="Amount"
                        v-model="form.amount"
                        :error="form.errors.amount"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <base-input
                        type="number"
                        label="Unit Price"
                        v-model="form.unit_price"
                        :error="form.errors.unit_price"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>
