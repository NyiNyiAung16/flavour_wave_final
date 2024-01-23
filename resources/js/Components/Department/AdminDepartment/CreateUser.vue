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
    image_url:null,
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

const getImage = (e) => {
    form.image_url = e.target.files[0];
}

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
        <form class="grid grid-cols-2 gap-3" @submit.prevent="createUser">
            <div class="space-y-4">
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
                    <label class="block mb-1">Image</label>
                    <label class="mb-1 text-gray-50 hover:text-gray-300 duration-150 block bg-gray-700 border-none p-2 rounded cursor-pointer" for="image">Choose an image</label>
                    <input class="hidden" type="file" id="image" @change="getImage">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.image_url">{{ form.errors.image_url }}</p>
                </div>
            </div>
            <div class="space-y-4 ">
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

