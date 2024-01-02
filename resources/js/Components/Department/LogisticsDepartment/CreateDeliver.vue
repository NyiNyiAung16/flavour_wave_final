<script setup>
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
                <label class="mb-1 text-gray-50 block" for="preorderid">Preorder ID</label>
                <input type="number" id="preorderid" v-model="form.preorder_id" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:Burmese Bliss">
                <p class="text-sm text-red-500 my-1" v-if="form.errors.preorder_id">{{ form.errors.preorder_id }}</p>
            </div>
            <div>
                <label class="mb-1 text-gray-50 block" for="quantity">Quantity</label>
                <input type="number" id="quantity" v-model="form.quantity" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:Burmese Bliss">
                <p class="text-sm text-red-500 my-1" v-if="form.errors.quantity">{{ form.errors.quantity }}</p>
            </div>
            <div>
                <label class="mb-1 text-gray-50 block" for="driverid">Driver ID</label>
                <input type="number" id="driverid" v-model="form.driver_id" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:Burmese Bliss">
                <p class="text-sm text-red-500 my-1" v-if="form.errors.driver_id">{{ form.errors.driver_id }}</p>
            </div>
            <button type="submit" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold">Create</button>
        </form>
    </div>
</template>

