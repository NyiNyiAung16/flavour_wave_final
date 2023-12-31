<script setup>
import { useForm,router } from '@inertiajs/vue3'
import { useToast } from 'vue-toastification';


const form = useForm({
    name:'',
    email:'',
    image_url:null,
    password:'',
    password_confirmation:'',
    department:'default'
});

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
                    <label class="mb-1 text-gray-50 block" for="username">Username</label>
                    <input type="text" id="username" v-model="form.name" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:Alex">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.name">{{ form.errors.name }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="email">Email</label>
                    <input type="email" id="productName" v-model="form.email" class="w-full bg-gray-700 border-none p-2 rounded outline-none" placeholder="eg:alex@gmail.com">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.email">{{ form.errors.email }}</p>
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
                    <label class="mb-1 text-gray-50 block" for="password">Department</label>
                    <select v-model="form.department" class="w-full bg-gray-700 border-none p-2 rounded outline-none">
                        <option value="default" disabled selected>Choose a department</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="SALE">SALE</option>
                        <option value="LOGISTIC">LOGISTIC</option>
                        <option value="FACTORY">FACTORY</option>
                        <option value="WAREHOUSE">WAREHOUSE</option>
                    </select>
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.department">{{ form.errors.department }}</p>
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="password">Password</label>
                    <input type="password" id="password" v-model="form.password" class="w-full bg-gray-700 border-none p-2 rounded outline-none">
                </div>
                <div>
                    <label class="mb-1 text-gray-50 block" for="confirmpassword">Confrim Password</label>
                    <input type="password" id="confirmpassword" v-model="form.password_confirmation" class="w-full bg-gray-700 border-none p-2 rounded outline-none">
                    <p class="text-sm text-red-500 my-1" v-if="form.errors.password">{{ form.errors.password }}</p>
                </div>
            </div>
            <button class="inline-block px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-200 rounded">Create</button>
        </form>
    </div>
</template>

