<!-- <script setup>


</script>


<template>
    <div>
        
    </div>
</template>
 -->

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm,router } from '@inertiajs/vue3'
import { useToast } from 'vue-toastification';

const props = defineProps({
    user:{
        type:Object
    }
})

const form = useForm({
    name:props.user.name,
    email:props.user.email,
    image_url:null,
    department:props.user.department
});

const getImage = (e) => {
    form.image_url = e.target.files[0];
}

const EditUser = () => {
    if(form.department === 'default'){
        form.department = ''
    }
    form.patch(route('user.patch',props.user.id),{
        onSuccess:() => {
            form.reset();
            router.get(route('adminDepartment.index'));
            useToast().success('message', 'Edit User is successful.');
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

const toggle = ref('allUser');

</script>


<template>
    <Head title="AdminDepartment" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">
                <h2 class="font-semibold text-gray-200 hover:text-gray-300 duration-150 text-lg leading-tight cursor-pointer"
                :class="{'underline':toggle === 'allUser'}"
                @click="toggle = 'allUser'"
                >
                    Edit User
                </h2>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <form class="grid grid-cols-2 gap-3" @submit.prevent="EditUser">
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
                            <button class="inline-block px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-200 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

 
