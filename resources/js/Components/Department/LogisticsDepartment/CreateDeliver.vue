<script setup>
import BaseInput from '@/Components/BaseInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    preorders:{
        type:Array,
        default:[]
    },
    drivers:{
        type:Array,
        default:[]
    }
})

const form = useForm({
    'preorder_id':0,
    'quantity':0,
    'driver_id':0
});

let errors = ref({});

const createDeliver = () => {
    errors.value = checkDataInForm(form);

    setTimeout(() => {
        errors.value = {}
    }, 2000);

    if(errors.value.preorder_id) return;
    if(errors.value.quantity) return;

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
    });
}


const checkDataInForm = (form) =>{
    let errors = {
        preorder_id:'',
        quantity:'',
        driver_id:''
    };
    //preorder id and quantity
    props.preorders.forEach((p)=>{
        if(form.preorder_id != p.id){
            errors.preorder_id = 'Your preorder id is valid.'
        }
        if(form.quantity <= 0){
            errors.quantity = 'Your quantity is not less than preorder quantity.'
        }
        if(form.quantity > p.order_quantity){
            errors.quantity = 'Your quantity is greater than preorder quantity.'
        }
    });
    //driver id
    let driver = props.drivers.find((d)=>{
        return d.id == form.driver_id;
    });
    if(!driver){
        errors.driver_id = 'Your driver id is valid.'
    }else if(driver.isFree === false || driver.isFree === 0){
        errors.driver_id = 'This driver is busy.'
    }

    return errors;
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
                <p class="text-sm text-red-500 my-1" v-if="errors.preorder_id">{{ errors.preorder_id }}</p>
            </div>
            <div>
                <BaseInput
                    type="number"
                    label="Quantity"
                    v-model="form.quantity"
                    :error="form.errors.quantity"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
                <p class="text-sm text-red-500 my-1" v-if="errors.quantity">{{ errors.quantity }}</p>
            </div>
            <div>
                <BaseInput
                    type="number"
                    label="Driver ID"
                    v-model="form.driver_id"
                    :error="form.errors.driver_id"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
                <p class="text-sm text-red-500 my-1" v-if="errors.driver_id">{{ errors.driver_id }}</p>
            </div>
            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

