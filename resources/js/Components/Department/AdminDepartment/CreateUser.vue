<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import BaseSelect from '@/Components/BaseSelect.vue'
import Button from '@/Components/Button.vue'
import { useForm,router } from '@inertiajs/vue3'
import { ref } from 'vue';
import { useToast } from 'vue-toastification';


const form = useForm({
    name:'',
    email:'',
    password:'',
    password_confirmation:'',
    department:'default'
});

const departmentOptions = ref([
    { label: 'ADMIN' , value:'ADMIN' },
    { label: 'SALE' , value:'SALE' },
    { label: 'LOGISTIC' , value:'LOGISTIC' },
    { label: 'FACTORY' , value:'FACTORY' },
    { label: 'WAREHOUSE' , value:'WAREHOUSE' },
]);

const createUser = () => {
    if(form.department === 'default'){
        form.department = ''
    }
    form.post(route('user.store'),{
        onSuccess:() => {
            form.reset();
            router.get(route('adminDepartment.index'));
            useToast().success('message', 'Create User is successful.')
        },
        onError:() => {
            setTimeout(()=>{
                form.clearErrors();
            },2000)
        }
    });
    if(form.department === ''){
        form.department = 'default';
    }
}

</script>


<template>
    <div>
        <form class="max-w-4xl mx-auto space-y-5" @submit.prevent="createUser">
            <h3 class="text-2xl font-bold text-center text-gray-100">Create User</h3>
            <div>
                <base-input
                    type="text"
                    v-model="form.name"
                    :error="form.errors.name"
                    label="Username"
                    placeholder="eg:Alex"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-input
                    type="email"
                    v-model="form.email"
                    :error="form.errors.email"
                    label="Email"
                    placeholder="eg:alex@gmail.com"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-select
                    label="Department"
                    v-model="form.department"
                    :options="departmentOptions"
                    :error="form.errors.department"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-input
                    type="password"
                    v-model="form.password"
                    label="Password"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <base-input
                    type="password"
                    v-model="form.password_confirmation"
                    label="Confrim Password"
                    :error="form.errors.password"
                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                />
            </div>
            <div>
                <Button
                    text="Create"
                    class="inline-block px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-200 rounded"
                />
            </div>
        </form>
    </div>
</template>

