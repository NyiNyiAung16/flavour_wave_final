<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import Button from '@/Components/Button.vue'
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
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="isFree" v-model="form.isFree" class="bg-gray-700 border-none p-2 rounded outline-none" >
                    <label class=" text-gray-50" for="isFree">is Free?</label>
                </div>
                <p class="text-sm text-red-500 my-1" v-if="form.errors.isFree">{{ form.errors.isFree }}</p>
            </div>
            <div>
                <Button
                    type="submit"
                    text="Create"
                    class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 rounded font-bold"
                />
            </div>
        </form>
    </div>
</template>

