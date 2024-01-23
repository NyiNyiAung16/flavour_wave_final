<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import Button from '@/Components/Button.vue'
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    product_id:0,
    opening_balance:0,
    sales_issue:0,
    received:0,
    availability:0,
    sales_return:0,
    damage:0,
    closing_balance:0
});

const CreateFactory = () => {
    form.post(route('warehouse.store'),{
        onSuccess:()=>{
            form.reset();
        },
        onError:()=>{
            setTimeout(() => {
                form.clearErrors();
            }, 2000);
        }
    });
    console.log(form)
}

</script>


<template>
    <form @submit.prevent="CreateFactory">
        <div class="grid grid-cols-2 gap-3">
            <div class="space-y-4">
                <div>
                    <BaseInput
                        type="number"
                        label="Product ID"
                        v-model="form.product_id"
                        :error="form.errors.product_id"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <BaseInput
                        type="number"
                        label="Opening Balance"
                        v-model="form.opening_balance"
                        :error="form.errors.opening_balance"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <BaseInput
                        type="number"
                        label="Sales Issue"
                        v-model="form.sales_issue"
                        :error="form.errors.sales_issue"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <BaseInput
                        type="number"
                        label="Received"
                        v-model="form.received"
                        :error="form.errors.received"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <BaseInput
                        type="number"
                        label="Availability"
                        v-model="form.availability"
                        :error="form.errors.availability"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <BaseInput
                        type="number"
                        label="Sales Return"
                        v-model="form.sales_return"
                        :error="form.errors.sales_return"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <BaseInput
                        type="number"
                        label="Damage"
                        v-model="form.damage"
                        :error="form.errors.damage"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
                <div>
                    <BaseInput
                        type="number"
                        label="Closing Balance"
                        v-model="form.closing_balance"
                        :error="form.errors.closing_balance"
                        class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                    />
                </div>
            </div>
            <div>
                <Button 
                    type="submit"
                    text="Create"
                />
            </div>
        </div>
    </form>
</template>

