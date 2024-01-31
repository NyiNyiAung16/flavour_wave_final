<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm,router } from '@inertiajs/vue3'
import { useToast } from 'vue-toastification';


const form = useForm({
    name:'',
});


const createDepartment = () => {
    form.name = form.name.toUpperCase();
    form.post(route('department.store'),{
        onSuccess:() => {
            form.reset();
            router.get(route('adminDepartment.index'));
            useToast().success('message', 'Create Department is successful.')
        },
        onError:() => {
            setTimeout(()=>{
                form.clearErrors();
            },2000)
        }
    });
}

</script>


<template>
    <div>
        <form class="max-w-3xl mx-auto space-y-3 py-3" @submit.prevent="createDepartment">
            <h3 class="text-2xl font-bold text-center text-gray-100">Create Department</h3>
            <div>
                <base-input
                    type="text"
                    v-model="form.name"
                    :error="form.errors.name"
                    label="Name"
                    placeholder="eg:ADMIN"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

