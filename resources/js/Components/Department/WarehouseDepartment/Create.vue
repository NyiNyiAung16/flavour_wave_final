<script setup>
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
                    <label class="mb-1 text-gray-50 block" for="productid">Product ID</label>
                    <input type="number" id="productid" v-model="form.product_id" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:1">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.product_id">{{ form.errors.product_id }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="opening_balance">Opening Balance</label>
                    <input type="number" id="opening_balance" v-model="form.opening_balance" class="w-full bg-gray-700 border-none p-2 rounded outline-none resize-none" placeholder="eg:100" />
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.opening_balance">{{ form.errors.opening_balance }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="salesIssue">Sales Issue</label>
                    <input type="number" id="salesIssue" v-model="form.sales_issue" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:1">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.sales_issue">{{ form.errors.sales_issue }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="received">Received</label>
                    <input type="number" id="received" v-model="form.received" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:3">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.received">{{ form.errors.received }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="mb-1 text-gray-50 block" for="availability">Availability</label>
                    <input type="number" id="availability" v-model="form.availability" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:90">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.availability">{{ form.errors.availability }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="sales_return">Sales Return</label>
                    <input type="number" id="sales_return" v-model="form.sales_return" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:1">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.sales_return">{{ form.errors.sales_return }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="damage">Damage</label>
                    <input type="number" id="damage" v-model="form.damage" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:3">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.damage">{{ form.errors.damage }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="closing_balance">Closing Balance</label>
                    <input type="number" id="closing_balance" v-model="form.closing_balance" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:70">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.closing_balance">{{ form.errors.closing_balance }}</p>
                </div>
            </div>
            <button type="submit" class="mt-2 px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold">Create</button>
        </div>
    </form>
</template>

