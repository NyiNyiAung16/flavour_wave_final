<script setup>
import NavLink from '@/Components/NavLink.vue'
import BaseInput from '@/Components/BaseInput.vue';
import BaseSelect from '@/Components/BaseSelect.vue';
import Button from '@/Components/Button.vue';
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
    department:props.user.department
});

const departmentOptions = ref([
    { label: 'ADMIN' , value:'ADMIN' },
    { label: 'SALE' , value:'SALE' },
    { label: 'LOGISTIC' , value:'LOGISTIC' },
    { label: 'FACTORY' , value:'FACTORY' },
    { label: 'WAREHOUSE' , value:'WAREHOUSE' },
]);

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
            <div class="flex flex-col gap-5">
                <NavLink 
                    v-show="$page.props.auth.user.isAdmin && $page.props.auth.user.department === 'ADMIN'" 
                    :href="route('adminDepartment.index')" 
                    :active="route().current('adminDepartment.index')"
                >
                    Dashboard
                </NavLink>
                <p class="sideBar active-sideBar"
                >
                    Edit User
                </p>
            </div>
        </template>
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <form class="max-w-3xl mx-auto py-2" @submit.prevent="EditUser">
                        <h3 class="text-2xl font-semibold text-center mb-3">Edit User</h3>
                        <div class="space-y-4">
                            <div>
                                <BaseInput
                                    type="text"
                                    label="Username"
                                    v-model="form.name"
                                    :error="form.errors.name"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                    placeholder="eg:Alex"
                                />
                            </div>
                            <div>
                                <BaseInput
                                    type="email"
                                    label="Email"
                                    v-model="form.email"
                                    :error="form.errors.email"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                    placeholder="eg:alex@gmail.com"
                                />
                            </div>
                            <div>
                                <BaseSelect
                                    label="Department"
                                    v-model="form.department"
                                    :options="departmentOptions"
                                    :error="form.errors.department"
                                    class="w-full bg-gray-700 border-none p-2 rounded outline-none"
                                />
                            </div>
                            <div>
                                <Button
                                    type="submit"
                                    text="Update"
                                    class="inline-block px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-200 rounded"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

 
