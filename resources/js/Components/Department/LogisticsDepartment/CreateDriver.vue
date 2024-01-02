<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    'name':'',
    'vehicle_number':'',
    'isFree':false
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
    <div>
        <form @submit.prevent="createDriver" class="space-y-4 max-w-4xl">
            <div>
                <label class="mb-1 text-gray-50 block" for="name">Name</label>
                <input type="text" id="name" v-model="form.name" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:U Myo">
                <p class="text-sm text-red-500 my-1" v-if="form.errors.name">{{ form.errors.name }}</p>
            </div>
            <div>
                <label class="mb-1 text-gray-50 block" for="vehicleNumber">Vehicle Number</label>
                <input type="text" id="vehicleNumber" v-model="form.vehicle_number" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:2C/9800">
                <p class="text-sm text-red-500 my-1" v-if="form.errors.vehicle_number">{{ form.errors.vehicle_number }}</p>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="isFree" v-model="form.isFree" class="bg-gray-700 border-none p-2 rounded outline-none" >
                    <label class=" text-gray-50" for="isFree">is Free?</label>
                </div>
                <p class="text-sm text-red-500 my-1" v-if="form.errors.isFree">{{ form.errors.isFree }}</p>
            </div>
            <button type="submit" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold">Create</button>
        </form>
    </div>
</template>

