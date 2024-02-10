<script setup>
import BaseInput from '@/Components/BaseInput.vue'
import BaseSelect from '@/Components/BaseSelect.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm,router } from '@inertiajs/vue3'
import { ref } from 'vue';
import { useToast } from 'vue-toastification';


const props = defineProps({
    departments:{
        type:Array,
        required:true
    }
})

const form = useForm({
    name:'',
    email:'',
    password:'',
    password_confirmation:'',
    department_id:'default'
});

const departmentOptions = ref([]);

props.departments.forEach((d)=>{
    departmentOptions.value.push({ label: d.name , value:d.id });
})


const createUser = () => {
    if(form.department_id === 'default'){
        form.department_id = ''
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
    if(form.department_id === ''){
        form.department_id = 'default';
    }
}

</script>


<template>
    <div class="p-2">
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
                    v-model="form.department_id"
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
                <PrimaryButton>Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

